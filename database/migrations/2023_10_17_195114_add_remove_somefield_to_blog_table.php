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
        Schema::table('blog', function (Blueprint $table) {
            $table->dateTime('published_date_time')->nullable()->after('schedule');
            $table->integer('is_comment')->default(0)->after('is_commentable');
            $table->integer('is_approved')->default(0)->after('is_comment');
            $table->bigInteger('views')->default(0)->after('is_approved');
            $table->string('author')->nullable()->after('views');
            $table->dropColumn('schedule_date');
            $table->dropColumn('is_category_color');
            $table->dropColumn('category_color');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog', function (Blueprint $table) {
            $table->dropColumn('published_date_time');
            $table->dropColumn('is_comment');
            $table->dropColumn('is_approved');
            $table->dropColumn('views');
            $table->dropColumn('author');
            $table->dateTime('schedule_date')->nullable();
            $table->tinyInteger('is_category_color')->nullable();
            $table->string('category_color')->nullable();

        });
    }
};
