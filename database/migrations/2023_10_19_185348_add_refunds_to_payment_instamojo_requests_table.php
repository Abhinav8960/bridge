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
            $table->boolean('is_refund')->default(0)->after('status');
            $table->string('refund_reason')->nullable()->after('is_refund');
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
            $table->dropColumn('is_refund');
            $table->dropColumn('refund_reason');
        });
    }
};
