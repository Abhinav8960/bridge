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
        Schema::table('institutes', function (Blueprint $table) {
            $table->string('google_institute_address')->nullable()->after('pincode');
            $table->double('latitude')->nullable()->after('google_institute_address');
            $table->double('longitude')->nullable()->after('latitude')->after('latitude');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->dropColumn('google_institute_address');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
};
