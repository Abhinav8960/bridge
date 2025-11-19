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
        Schema::table('payment_instamojo_requests', function (Blueprint $table) {
            $table->unsignedInteger('billing_account_id')->after('sac_code_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_instamojo_requests', function (Blueprint $table) {
            $table->dropColumn('billing_account_id');
            
        });
    }
};
