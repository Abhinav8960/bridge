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
        Schema::table('leaderbaord_cities', function (Blueprint $table) {
            $table->unsignedInteger('state_id')->after('institute_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leaderbaord_cities', function (Blueprint $table) {
            $table->dropColumn('state_id');
        });
    }
};
