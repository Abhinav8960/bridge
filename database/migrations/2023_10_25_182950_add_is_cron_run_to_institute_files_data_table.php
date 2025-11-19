<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('institute_files_data', function (Blueprint $table) {
            $table->boolean('is_cron_run')->default(0)->after('is_migrated');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('institute_files_data', function (Blueprint $table) {
            $table->dropColumn('is_cron_run');
            
        });
    }
};

