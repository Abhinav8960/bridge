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
        Schema::create('tax_breakups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tax_id')->nullable();
            $table->string('name')->nullable();
            $table->double('percentage', 8, 2)->comment('in %');
            $table->tinyInteger('status')->default(1);
            $table->blameable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->dateTime('created_at', $precision = 0);
            $table->dateTime('updated_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_breakups');
    }
};
