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
        Schema::create('spotlites', function (Blueprint $table) {
            $table->id();
            $table->string('institute_name')->nullable();
            $table->string('location')->nullable();
            $table->string('establish_year')->nullable();
            $table->string('batch_training')->nullable();
            $table->string('virtual_classroom')->nullable();
            $table->text('description')->nullable();
            $table->string('institute_url')->nullable();
            $table->string('dyntube_project_id')->nullable();
            $table->string('dyntube_video_id')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->blameable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('spotlites');
    }
};
