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
        Schema::create('institute_stream_exam_files_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('institute_files_id');
            $table->unsignedInteger('institute_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('stream_id');
            $table->unsignedBigInteger('exam_id');
            $table->dateTime('created_at', $precision = 0);
            $table->dateTime('updated_at', $precision = 0);
            $table->tinyInteger('is_migrated')->default(0);
            $table->boolean('is_cron_run')->default(0);
            $table->longText('any_error')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institute_stream_exam_files_data');
    }
};
