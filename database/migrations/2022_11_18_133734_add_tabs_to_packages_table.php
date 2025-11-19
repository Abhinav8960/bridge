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
            $table->boolean('is_showing_general')->default(1)->after('is_course_enrollment');
            $table->boolean('is_showing_courses')->default(0)->after('is_showing_general');
            $table->boolean('is_showing_champions')->default(0)->after('is_showing_courses');
            $table->boolean('is_showing_uploads')->default(0)->after('is_showing_champions');
            $table->boolean('is_showing_faculty')->default(0)->after('is_showing_uploads');
            $table->boolean('is_showing_centers')->default(0)->after('is_showing_faculty');
            $table->boolean('is_showing_videos')->default(0)->after('is_showing_centers');
            $table->boolean('is_showing_alumni')->default(0)->after('is_showing_videos');
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
            $table->dropColumn('is_showing_general');
            $table->dropColumn('is_showing_courses');
            $table->dropColumn('is_showing_champions');
            $table->dropColumn('is_showing_uploads');
            $table->dropColumn('is_showing_faculty');
            $table->dropColumn('is_showing_centers');
            $table->dropColumn('is_showing_videos');
            $table->dropColumn('is_showing_alumni');
        });
    }
};
