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
        Schema::table('exam_categories', function (Blueprint $table) {
            $table->boolean('is_show_homepage')->default(1)->after('mobile_category_page_banner');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_categories', function (Blueprint $table) {
            $table->dropColumn('is_show_homepage');
            
        });
    }
};
