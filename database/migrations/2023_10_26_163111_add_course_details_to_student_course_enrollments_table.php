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
        Schema::table('student_course_enrollments', function (Blueprint $table) {
            $table->string('course_title')->nullable()->after('course_id');
            $table->unsignedInteger('duration')->default(0)->after('course_title');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_course_enrollments', function (Blueprint $table) {
            $table->dropColumn('course_title');
            $table->dropColumn('duration');
            
        });
    }
};
