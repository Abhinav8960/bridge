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
        Schema::create('instamojo_refunds', function (Blueprint $table) {
            $table->id();
            $table->string('refund_id');
            $table->string('payment_id');
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('body')->nullable();
            $table->double('refund_amount')->default(0);
            $table->double('total_amount')->default(0);
            $table->string('creator_name')->default(0);
            $table->string('refund_created_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instamojo_refunds');
    }
};
