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
            $table->double('taxable_amount', 10, 2)->default(0)->after('amount_without_tax');
            $table->double('net_amount', 10, 2)->default(0)->after('taxable_amount');
            $table->double('grand_total', 10, 2)->default(0)->after('net_amount');
            $table->double('round_off', 10, 2)->default(0)->after('grand_total');
            $table->double('amount_charged', 10, 2)->default(0)->after('round_off');
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
            $table->dropColumn('taxable_amount');
            $table->dropColumn('net_amount');
            $table->dropColumn('grand_total');
            $table->dropColumn('round_off');
            $table->dropColumn('amount_charged');
            
        });
    }
};
