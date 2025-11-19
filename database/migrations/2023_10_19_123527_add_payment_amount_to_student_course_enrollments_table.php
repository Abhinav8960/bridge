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
            $table->double('taxable_amount', 10, 2)->default(0)->after('amount_without_tax');
            $table->double('net_amount', 10, 2)->default(0)->after('taxable_amount');
            $table->double('grand_total', 10, 2)->default(0)->after('net_amount');
            $table->double('round_off', 10, 2)->default(0)->after('grand_total');
            $table->double('amount_charged', 10, 2)->default(0)->after('round_off');
            $table->double('booking_fees', 10, 2)->default(0)->after('amount_charged');
            $table->double('course_fees', 10, 2)->default(0)->after('booking_fees');
            $table->unsignedInteger('course_discount_percentage')->default(0)->after('course_fees');
            $table->double('course_discount_rupees', 10, 2)->default(0)->after('course_discount_percentage');
            $table->unsignedInteger('location')->default(0)->after('course_discount_rupees');
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
            $table->dropColumn('taxable_amount');
            $table->dropColumn('net_amount');
            $table->dropColumn('grand_total');
            $table->dropColumn('round_off');
            $table->dropColumn('amount_charged');
            $table->dropColumn('booking_fees');
            $table->dropColumn('course_fees');
            $table->dropColumn('course_discount_percentage');
            $table->dropColumn('course_discount_rupees');
            $table->dropColumn('location');
        });
    }
};
