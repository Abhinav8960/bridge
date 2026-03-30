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
        Schema::create('centers', function (Blueprint $table) {
            $table->id();
            $table->integer('institute_id');
            $table->string('center_head');
            $table->integer('branch_type');
            $table->string('google_business_address');
            $table->string('address');
            $table->integer('country_id');
            $table->string('country_name');
            $table->string('country_code');
            $table->integer('state_id');
            $table->string('state_name');
            $table->integer('city_id');
            $table->string('city_name');
            $table->string('area');
            $table->integer('pincode');
            $table->string('email_1');
            $table->string('email_2')->nullable();
            $table->integer('phone_type_1')->nullable();
            $table->bigInteger('phone_number_1')->nullable();
            $table->integer('phone_type_2')->nullable();
            $table->bigInteger('phone_number_2')->nullable();
            $table->tinyInteger('sunday')->default(0);
            $table->time('sunday_open')->nullable();
            $table->time('sunday_close')->nullable();
            $table->tinyInteger('monday')->default(0);
            $table->time('monday_open')->nullable();
            $table->time('monday_close')->nullable();
            $table->tinyInteger('tuesday')->default(0);
            $table->time('tuesday_open')->nullable();
            $table->time('tuesday_close')->nullable();
            $table->tinyInteger('wednesday')->default(0);
            $table->time('wednesday_open')->nullable();
            $table->time('wednesday_close')->nullable();
            $table->tinyInteger('thursday')->default(0);
            $table->time('thursday_open')->nullable();
            $table->time('thursday_close')->nullable();
            $table->tinyInteger('friday')->default(0);
            $table->time('friday_open')->nullable();
            $table->time('friday_close')->nullable();
            $table->tinyInteger('saturday')->default(0);
            $table->time('saturday_open')->nullable();
            $table->time('saturday_close')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('centers');
    }
};
