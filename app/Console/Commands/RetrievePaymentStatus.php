<?php

namespace App\Console\Commands;

use App\Helpers\InstaMojoHelper;
use App\Models\PaymentInstamojoRequest;
use Illuminate\Console\Command;

class RetrievePaymentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'retrievepaymentstatus:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'last 24 hr instamojo payment that not success get payament status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $from = \Carbon\Carbon::now()->subHours(3);
        $to = \Carbon\Carbon::now();

        // $model =  PaymentInstamojoRequest::whereBetween('created_at', [$from, $to])->where('payment_status','Pending')->where('order_status',NULL)->get();
        $models =  PaymentInstamojoRequest::whereBetween('created_at', [$from, $to])->where('order_status', NULL)->get();
        // $models =  PaymentInstamojoRequest::where('payment_status', 'Pending')->where('id','>' ,8)->where('order_status', NULL)->get();

        if ($models->count() > 0) {
            foreach ($models as $model) {
                $request_status = InstaMojoHelper::getPaymentstatus($model->payment_request_id);

                if (isset($request_status->status)) {

                    // print_r($request_status->status);
                    if (isset($request_status->payments)) {
                        $payment_id = explode("/", current($request_status->payments));
                        $count = count($payment_id);
                        if ($count  > 1) {
                            if (isset($payment_id[$count - 2]) && !empty($payment_id[$count - 2])) {

                                $p_i = $payment_id[$count - 2];
                                if (!empty($p_i)) {
                                    echo $p_i;
                                    echo "<br>";
                                    echo $model->id;
                                    $model->payment_id = $p_i;
                                    $model->save();
                                    InstaMojoHelper::PaymentDeatils($p_i);
                                }
                            }
                        }
                    }
                }
            }
        }
        echo \Carbon\Carbon::now()->format('Y-m-d H:i:S');
    }
}
