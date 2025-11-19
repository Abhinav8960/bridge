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
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institute_id');
            $table->longText('description')->nullable();          
            $table->string('email_1');
            $table->string('email_2')->nullable();
            $table->enum('phone_type_1', ['Mobile', 'Landline'])->nullable();
            $table->bigInteger('phone_number_1')->nullable();
            $table->enum('phone_type_2', ['Mobile', 'Landline'])->nullable();
            $table->bigInteger('phone_number_2')->nullable();

            $table->tinyInteger('admission_screening')->default(0);
            $table->string('admission_screening_url')->nullable();

            $table->tinyInteger('mock_test')->default(0);
            $table->string('mock_test_url')->nullable();

            // $table->string('founded')->nullable();
            // $table->tinyInteger('batch_training')->default(0);
            // $table->tinyInteger('personalized_training')->default(0);
            // $table->tinyInteger('virtual_classroom')->default(0);
            // $table->tinyInteger('doubt_session')->default(0);
            // $table->tinyInteger('online_test_series')->default(0);
            // $table->tinyInteger('mentor_session')->default(0);
            // $table->tinyInteger('choice_of_faculty')->default(0);
            // $table->tinyInteger('study_material')->default(0);
            // $table->tinyInteger('resource_library')->default(0);
            // $table->tinyInteger('performance_assessment')->default(0);
            // $table->tinyInteger('admission_counselling')->default(0);
            
            $table->string('leadership_name');
            $table->string('leadership_designation');
            $table->string('leadership_image');
            $table->longText('leadership_description');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('generals');
    }
};
