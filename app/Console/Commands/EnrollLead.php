<?php

namespace App\Console\Commands;

use App\Helpers\LeadHelper;
use App\Models\EnrollContact;
use Illuminate\Console\Command;

class EnrollLead extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Enroll:Lead';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'to fetch data from  db then send to api';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $enrollcontacts  = EnrollContact::where('api_status', false)->limit(30)->get();


        foreach ($enrollcontacts as $contact) {
            $response = LeadHelper::getEnrollLead($contact);
            \Log::channel('lead')->info('Lead Helper : ' . json_encode($response));
            $res = json_decode(json_encode($response), true);

            EnrollContact::where('id', $contact->id)->update([
                'api_status' => isset($res['status']) ? $res['status'] : 0,
                'api_message' => isset($res['message']) ? $res['message'] : NUll,
            ]);
        }



        return Command::SUCCESS;
    }
}
