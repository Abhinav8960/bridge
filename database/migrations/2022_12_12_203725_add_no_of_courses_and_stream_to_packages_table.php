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
        Schema::table('packages', function (Blueprint $table) {
            $table->unsignedInteger('no_of_courses')->after('no_of_centers')->default(0);            
            $table->unsignedInteger('no_of_streams')->after('no_of_courses')->default(0);            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('no_of_courses');            
            $table->dropColumn('no_of_streams');            
            
        });
    }
};
