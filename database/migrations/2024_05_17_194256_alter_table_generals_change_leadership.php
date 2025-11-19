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
        Schema::table('generals', function (Blueprint $table) {
            $table->string('leadership_name')->nullable()->change();
            $table->string('leadership_designation')->nullable()->change();
            $table->string('leadership_image')->nullable()->change();
            $table->longText('leadership_description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('generals', function (Blueprint $table) {
            $table->string('leadership_name')->change();
            $table->string('leadership_designation')->change();
            $table->string('leadership_image')->change();
            $table->longText('leadership_description')->change();
        });
    }
};
