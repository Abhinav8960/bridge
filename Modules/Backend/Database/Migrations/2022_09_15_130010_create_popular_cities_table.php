<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popular_cities', function (Blueprint $table) {
            $table->id();
            $table->integer('state_id');
            $table->string('state_name');
            $table->integer('city_id');
            $table->string('city_name');
            $table->string('icon')->nullable();
            $table->tinyInteger('is_metro')->default(1);
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
        Schema::dropIfExists('popular_cities');
    }
};
