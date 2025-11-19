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
        Schema::create('instamojo_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('access_token');
            $table->integer('expires_in');
            $table->dateTime('expires_in_datetime', $precision = 0);
            $table->string('scope');
            $table->string('token_type');
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
        Schema::dropIfExists('instamojo_tokens');
    }
};
