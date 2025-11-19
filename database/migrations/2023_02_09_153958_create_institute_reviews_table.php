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
        Schema::create('institute_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('institute_id');
            $table->unsignedInteger('student_id')->nullable();
            $table->string('title', 255);
            $table->text('review');
            $table->unsignedDouble('average_rating')->nullable();
            $table->unsignedDouble('overall_rating')->nullable();
            $table->unsignedDouble('coursestructure_rating')->nullable();
            $table->unsignedDouble('faculty_rating')->nullable();
            $table->unsignedDouble('infrastructure_rating')->nullable();
            $table->unsignedDouble('doubtsessions_rating')->nullable();
            $table->unsignedDouble('studymaterial_rating')->nullable();

            $table->blameable();
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
        Schema::dropIfExists('institute_reviews');
    }
};
