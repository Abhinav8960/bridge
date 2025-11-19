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
        Schema::create('popularsearches', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('rcategory')->default(0);
            $table->tinyInteger('rstream')->default(0);
            $table->tinyInteger('rexam')->default(0);
            $table->tinyInteger('rstate')->default(0);
            $table->tinyInteger('rcity')->default(0);
            $table->tinyInteger('rarea')->default(0);
            $table->string('slug')->nullable();
            $table->string('search')->nullable();
            $table->integer('count')->nullable();
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
        Schema::dropIfExists('popularsearches');
    }
};
