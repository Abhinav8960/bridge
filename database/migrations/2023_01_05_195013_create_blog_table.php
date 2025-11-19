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
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('post_slug')->nullable();
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->tinyInteger('schedule')->nullable()->default(0);
            $table->datetime('schedule_date')->nullable();
            $table->boolean('is_commentable')->nullable()->default(0);
            $table->boolean('is_category_color')->nullable()->default(0);
            $table->string('category_color')->nullable();
            $table->boolean('is_comment_moderation')->nullable()->default(0);
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->blameable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog');
    }
};
