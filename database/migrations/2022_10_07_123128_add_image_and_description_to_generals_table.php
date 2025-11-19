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
        Schema::table('generals', function (Blueprint $table) {
            $table->string('admission_screening_description')->after('admission_screening_url')->nullable();
            $table->string('admission_screening_image')->after('admission_screening_description')->nullable();
            $table->string('mock_test_description')->after('mock_test_url')->nullable();
            $table->string('mock_test_image')->after('mock_test_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('generals', function (Blueprint $table) {
            $table->dropColumn('admission_screening_description');
            $table->dropColumn('admission_screening_image');
            $table->dropColumn('mock_test_description');
            $table->dropColumn('mock_test_image');
        });
    }
};
