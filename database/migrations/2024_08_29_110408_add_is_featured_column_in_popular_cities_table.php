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
        Schema::table('popular_cities', function (Blueprint $table) {
            $table->tinyInteger('is_featured')->default(0)->after('city_name')->comment('1=>yes, 0=>no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('popular_cities', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });
    }
};
