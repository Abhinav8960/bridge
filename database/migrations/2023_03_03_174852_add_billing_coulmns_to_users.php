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
            $table->unsignedInteger('tax_id')->after('booking_fees');
            $table->unsignedInteger('tax_type_id')->after('tax_id');
            $table->unsignedInteger('sac_code_id')->after('tax_type_id');
            $table->unsignedInteger('billing_account_id')->after('sac_code_id');
            
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
            $table->dropColumn('tax_id');
            $table->dropColumn('tax_type_id');
            $table->dropColumn('sac_code_id');
            $table->dropColumn('billing_account_id');
            
        });
    }
};
