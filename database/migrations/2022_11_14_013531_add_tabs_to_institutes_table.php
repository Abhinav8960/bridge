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
            $table->boolean('is_showing_general')->default(1)->after('status');       
            $table->boolean('is_showing_courses')->default(1)->after('is_showing_general');       
            $table->boolean('is_showing_champions')->default(1)->after('is_showing_courses');       
            $table->boolean('is_showing_uploads')->default(1)->after('is_showing_champions');       
            $table->boolean('is_showing_faculty')->default(1)->after('is_showing_uploads');       
            $table->boolean('is_showing_centers')->default(1)->after('is_showing_faculty');       
            $table->boolean('is_showing_videos')->default(1)->after('is_showing_centers');       
            $table->boolean('is_showing_alumni')->default(1)->after('is_showing_videos');       
            
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
