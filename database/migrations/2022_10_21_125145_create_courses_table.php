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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();            
            $table->unsignedInteger('institute_id');
            $table->string('course_title');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedInteger('duration');
            $table->date('last_enrollment_date');
            $table->unsignedInteger('batch_size')->nullable();
            $table->unsignedFloat('booking_fees')->default(0);
            $table->unsignedFloat('total_fees')->default(0);
            $table->unsignedFloat('discount')->default(0);
            $table->boolean('accept_enrollment')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
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
        Schema::dropIfExists('courses');
    }
};
