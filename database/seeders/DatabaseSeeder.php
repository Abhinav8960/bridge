<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('parameters')->count() == 0){

            DB::table('parameters')->insert([

                [
                    'title' => 'Overall Rating ',
                    'status' => true,
                    'created_at'=> \Carbon\Carbon::now(),
                    'updated_at'=> \Carbon\Carbon::now(),
                ],
                [
                    'title' => 'Course Structure ',
                    'status' => true,
                    'created_at'=> \Carbon\Carbon::now(),
                    'updated_at'=> \Carbon\Carbon::now(),

                ],
                [

                    'title' => 'Faculty',
                    'status' => true,
                    'created_at'=> \Carbon\Carbon::now(),
                    'updated_at'=> \Carbon\Carbon::now(),
                ],
                [

                    'title' => 'Infrastructure',
                    'status' => true,
                    'created_at'=> \Carbon\Carbon::now(),
                    'updated_at'=> \Carbon\Carbon::now(),
                ],
                [

                    'title' => 'Doubt Sessions ',
                    'status' => true,
                    'created_at'=> \Carbon\Carbon::now(),
                    'updated_at'=> \Carbon\Carbon::now(),
                ],
                [

                    'title' => 'Study Material ',
                    'status' => true,
                    'created_at'=> \Carbon\Carbon::now(),
                    'updated_at'=> \Carbon\Carbon::now(),
                ]

            ]);

        } else { echo "Table is not empty, therefore NOT "; }
    }
}
