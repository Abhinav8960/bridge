<?php

namespace App\Console\Commands;

use App\Helpers\SmsHelper;
use App\Models\Institute;
use Illuminate\Console\Command;

class IntituteSuspenstionCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'IntituteSuspenstion:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Intitute Suspenstion if package validity expired';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

       $instituteexpired =  Institute::where('plan_valid_upto', '<', \Carbon\Carbon::now()->format('Y-m-d'))->where('is_plan_expired',false)
            ->update([
                'is_plan_expired' => true,
            ]);

            if (!empty($instituteexpired)) {
                foreach ($instituteexpired as $instituteexpire) {
                    // dd($instituteexpire);
                    $phone = $instituteexpire->mobile;
                    $name = $instituteexpire->name;
                    $onDate = \Carbon\Carbon::parse($instituteexpire->plan_valid_upto)->format('d M Y');
                    SmsHelper::instituteExpired($phone, $name, $onDate);
                }
            }

        return Command::SUCCESS;
    }
}
