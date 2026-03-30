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
        Schema::table('students', function (Blueprint $table) {
            $table->string('school_name')->after('name');       
            $table->string('actual_password')->after('remember_token');       
            $table->integer('otp')->after('actual_password')->nullable();       
            $table->dateTime('otp_generate_datetime', $precision = 0)->nullable()->after('otp');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('school_name');            
            $table->dropColumn('actual_password');            
            $table->dropColumn('otp');            
            $table->dropColumn('otp_generate_datetime');   
        });
    }
};
