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
        Schema::create('institute_files_data', function (Blueprint $table) {
            $table->id();
            $table->integer('institute_files_id');
            $table->string('name')->nullable();
            $table->string('authorized_person');
            $table->string('email');
            $table->string('mobile');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('state_id');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('area_id');
            $table->string('google_institute_address')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->string('website');
            $table->longtext('description')->nullable();
            $table->string('leadership_name');
            $table->string('leadership_designation');
            $table->unsignedInteger('duration');
            $table->boolean('is_recommended')->default(0);

            $table->text('any_error')->nullable();
            $table->tinyInteger('is_migrated')->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('institute_files_data');
    }
};
