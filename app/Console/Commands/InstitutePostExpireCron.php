<?php

namespace App\Console\Commands;

use App\Helpers\SmsHelper;
use App\Models\Institute;
use Illuminate\Console\Command;

class InstitutePostExpireCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'InstitutePostExpire:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Institute expired renew as soon as possible';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $date = \Carbon\Carbon::now();
        // dd($date);
        // $institutespostexpired =  Institute::whereRaw('DATE_FORMAT(`plan_valid_upto`, "%Y-%m-%d") = "'.$date.'" and is_plan_expired=1')->get();
        $institutespostexpired =  Institute::where('plan_valid_upto', '<', \Carbon\Carbon::now()->format('Y-m-d'))->where('is_plan_expired', true)->where('status', true)->get();
        if (!empty($institutespostexpired)) {
            foreach ($institutespostexpired as $institutespostexpire) {
                // dd($institutespostexpire);
                $phone = $institutespostexpire->mobile;
                $name = $institutespostexpire->name;
                $onDate = \Carbon\Carbon::parse($institutespostexpire->plan_valid_upto)->format('d M Y');
                SmsHelper::instituteExpired($phone, $name, $onDate);
            }
        }
        return Command::SUCCESS;
    }
}
