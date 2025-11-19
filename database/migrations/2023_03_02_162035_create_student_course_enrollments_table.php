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
        Schema::create('student_course_enrollments', function (Blueprint $table) {
            $table->id();
            $table->integer('payment_request_id');
            $table->integer('institute_id');
            $table->integer('course_id');
            $table->integer('student_id');
            $table->date('booking_date')->nullable();
            $table->integer('sac_code_id')->default(0);
            $table->integer('tax_type_id')->default(0);
            $table->integer('tax_id')->default(0);
            $table->string('purpose');
            $table->string('buyer_name');
            $table->string('email');
            $table->bigInteger('phone');
            $table->double('amount', 10, 2);
            $table->double('amount_without_tax', 10, 2);
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
        Schema::dropIfExists('student_course_enrollments');
    }
};
