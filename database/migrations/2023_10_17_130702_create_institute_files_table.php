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
        Schema::create('institute_files', function (Blueprint $table) {
            $table->id();
            $table->boolean('type')->default(1)->comment('1=>Institute,2=>Stream');
            $table->string('filename');
            $table->string('file_path');
            $table->string('total_record');
            $table->boolean('is_migration_runing')->default(0);
            $table->tinyInteger('is_migrated')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->blameable();
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
        Schema::dropIfExists('institute_files');
    }
};
