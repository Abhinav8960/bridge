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
            $table->string('teasure_line')->nullable()->after('name');
            $table->string('mobile_dashboard_banner')->nullable()->after('banner');
            $table->string('mobile_category_page_banner')->nullable()->after('mobile_dashboard_banner');
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
            $table->dropColumn('teasure_line');
            $table->dropColumn('mobile_dashboard_banner');
            $table->dropColumn('mobile_category_page_banner');
        });
    }
};
