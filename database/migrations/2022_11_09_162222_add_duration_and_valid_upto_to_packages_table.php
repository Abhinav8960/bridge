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
        Schema::table('institutes', function (Blueprint $table) {
            $table->unsignedInteger('duration')->nullable()->after('package_id');            
            $table->dateTime('plan_valid_from', $precision = 0)->nullable()->after('duration');       
            $table->dateTime('plan_valid_upto', $precision = 0)->nullable()->after('plan_valid_from');       
            $table->boolean('is_plan_expired')->default(0)->after('plan_valid_upto');       
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->dropColumn('duration');            
            $table->dropColumn('plan_valid_from');            
            $table->dropColumn('plan_valid_upto');            
            $table->dropColumn('is_plan_expired');            
            
        });
    }
};
