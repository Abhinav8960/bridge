<?php

namespace App\Console\Commands;

use App\Helpers\SmsHelper;
use App\Models\Institute;
use Illuminate\Console\Command;

class InstituteExpiredCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'InstituteExpired:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Institute Expired Or Suspended';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $institutespostexpired =  Institute::where('plan_valid_upto', '=', \Carbon\Carbon::now()->format('Y-m-d'))->where('is_plan_expired', true)->where('status', true)->get();
        if (!empty($institutespostexpired)) {
            foreach ($institutespostexpired as $institutespostexpire) {
                // dd($institutespostexpire);
                $phone = $institutespostexpire->mobile;
                $name = $institutespostexpire->name;
                $action = "expired";
                $actionStatus = "renew";
                SmsHelper::instituteExpired($phone, $name, $action, $actionStatus);
            }
        }

        $institutespostexpired =  Institute::where('status', false)->get();
        if (!empty($institutespostexpired)) {
            foreach ($institutespostexpired as $institutespostexpire) {
                // dd($institutespostexpire);
                $phone = $institutespostexpire->mobile;
                $name = $institutespostexpire->name;
                $action = "been suspended";
                $actionStatus = "activate";
                SmsHelper::instituteExpired($phone, $name, $action, $actionStatus);
            }
        }

        return Command::SUCCESS;
    }
}
