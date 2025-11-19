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
        Schema::create('payment_instamojo_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('institute_id');
            $table->integer('course_id');
            $table->integer('student_id');
            $table->integer('sac_code_id')->default(0);
            $table->integer('tax_type_id')->default(0);
            $table->integer('tax_id')->default(0);
            $table->string('purpose');
            $table->string('buyer_name');
            $table->string('email');
            $table->bigInteger('phone');
            $table->double('amount', 10, 2);
            $table->double('amount_without_tax', 10, 2);
            $table->tinyInteger('send_email')->default(0)->comment('will instamojo sending email');;
            $table->tinyInteger('send_sms')->default(0)->comment('will instamojo sending Sms');;
            $table->string('payment_request_id')->nullable();
            $table->string('user')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('sms_status')->nullable();
            $table->string('email_status')->nullable();
            $table->string('shorturl')->nullable();
            $table->string('longurl')->nullable();
            $table->string('redirect_url')->nullable();
            $table->string('webhook')->nullable();
            $table->string('scheduled_at')->nullable();
            $table->string('expires_at')->nullable();
            $table->string('allow_repeated_payments')->nullable();
            $table->string('mark_fulfilled')->nullable();
            $table->string('payment_request_created_at')->nullable();
            $table->string('payment_request_modified_at')->nullable();
            $table->string('resource_uri')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('title')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_request')->nullable();
            $table->string('link')->nullable();
            $table->string('product')->nullable();
            $table->string('seller')->nullable();
            $table->string('currency')->nullable();
            $table->string('name')->nullable();
            $table->string('payout')->nullable();
            $table->string('fees')->nullable();
            $table->string('total_taxes')->nullable();
            $table->string('affiliate_id')->nullable();
            $table->string('affiliate_commission')->nullable();
            $table->string('instrument_type')->nullable();
            $table->string('billing_instrument')->nullable();
            $table->string('failure')->nullable();
            $table->string('payment_order_created_at')->nullable();
            $table->string('payment_order_updated_at')->nullable();
            $table->string('tax_invoice_id')->nullable();
            $table->boolean('order_status')->nullable()->comment('true => Successful,false => Failed,* null => Initiated');
            $table->string('success')->nullable();
            $table->string('message')->nullable();
            $table->string('referral_code')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->blameable();
            $table->unsignedInteger('deleted_by');
            $table->dateTime('created_at', $precision = 0);
            $table->dateTime('updated_at', $precision = 0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_instamojo_requests');
    }
};
