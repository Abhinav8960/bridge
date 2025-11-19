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
        Schema::table('institute_contacts', function (Blueprint $table) {
            $table->tinyInteger('api_status')->default(0)->after('mesaage');
            $table->string('api_message')->nullable()->after('api_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('institute_contacts', function (Blueprint $table) {
            $table->dropColumn('api_status');
            $table->dropColumn('api_message');
        });
    }
};
