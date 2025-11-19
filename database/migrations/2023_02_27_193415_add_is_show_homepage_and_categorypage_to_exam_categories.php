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
        Schema::table('exam_streams', function (Blueprint $table) {
            $table->boolean('is_show_homepage')->default(0)->after('icon_hover');
            $table->boolean('is_show_categorypage')->default(0)->after('is_show_homepage');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_streams', function (Blueprint $table) {
            $table->dropColumn('is_show_homepage');
            $table->dropColumn('is_show_categorypage');
            
        });
    }
};
