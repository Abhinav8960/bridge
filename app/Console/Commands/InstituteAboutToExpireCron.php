<?php

namespace App\Console\Commands;

use App\Helpers\SmsHelper;
use App\Models\Institute;
use Illuminate\Console\Command;

class InstituteAboutToExpireCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'InstituteAboutToExpire:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Institute About To Expire';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $checkdate = 5;
        $date = \Carbon\Carbon::now()->addDays($checkdate);
        // dd($date);
        $institutesabouttoexpired =  Institute::whereRaw('DATE_FORMAT(`plan_valid_upto`, "%Y-%m-%d") = "'.$date->format("Y-m-d").'" and is_plan_expired=0')->get();
        if (!empty($institutesabouttoexpired)) {
            foreach ($institutesabouttoexpired as $institutesabouttoexpire) {
                // dd($institutesabouttoexpire->name);
                $phone = $institutesabouttoexpire->mobile;
                $institute = Institute::where('id', $institutesabouttoexpire->vendor)->first();
                $name = $institutesabouttoexpire->name;
                $beforedate = $checkdate." Days";
                SmsHelper::instituteAbouttoExpire($phone, $name, $beforedate);
            }
        }
        // $date = \Carbon\Carbon::now()->addDays(5);
        // $institutesabouttoexpired =  Institute::whereRaw('DATE_FORMAT(`plan_valid_upto`, "%Y-%m-%d") = "'.$date->format("Y-m-d").'" and is_plan_expired=0')->get();
        // if (!empty($institutesabouttoexpired)) {
        //     foreach ($institutesabouttoexpired as $institutesabouttoexpire) {
        //         $phone = $institutesabouttoexpire->mobile;
        //         $institute = Institute::where('id', $institutesabouttoexpire->vendor)->first();
        //         $name = $institutesabouttoexpire->name;
        //         $beforedate = "5 Days";
        //         SmsHelper::instituteAbouttoExpire($phone, $name, $beforedate);
        //     }
        // }
        return Command::SUCCESS;
    }
}
