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
            $table->string('course_fees')->nullable()->after('duration');
            $table->string('course_discount')->default(0)->after('course_fees');
            $table->double('payment_gateway_amount_charged', 10, 2)->after('payout');
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
            $table->dropColumn('course_fees');
            $table->dropColumn('course_discount');
            $table->dropColumn('payment_gateway_amount_charged');
        });
    }
};
