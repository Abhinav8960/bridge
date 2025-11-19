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
        Schema::table('institute_files_data', function (Blueprint $table) {
            $table->boolean('sunday')->after('is_recommended');
            $table->time('sunday_open')->after('sunday');
            $table->time('sunday_close')->after('sunday_open');

            $table->boolean('monday')->after('sunday_close');
            $table->time('monday_open')->after('monday');
            $table->time('monday_close')->after('monday_open');

            $table->boolean('tuesday')->after('monday_close');
            $table->time('tuesday_open')->after('tuesday');
            $table->time('tuesday_close')->after('tuesday_open');

            $table->boolean('wednesday')->after('tuesday_close');
            $table->time('wednesday_open')->after('wednesday');
            $table->time('wednesday_close')->after('wednesday_open');

            $table->boolean('thursday')->after('wednesday_close');
            $table->time('thursday_open')->after('thursday');
            $table->time('thursday_close')->after('thursday_open');

            $table->boolean('friday')->after('thursday_close');
            $table->time('friday_open')->after('friday');
            $table->time('friday_close')->after('friday_open');

            $table->boolean('saturday')->after('friday_close');
            $table->time('saturday_open')->after('saturday');
            $table->time('saturday_close')->after('saturday_open');

            $table->text('founded')->after('saturday_close');
            $table->boolean('batch_training')->after('founded');
            $table->boolean('personalised_training')->after('batch_training');
            $table->boolean('virtual_classroom')->after('personalised_training');
            $table->boolean('doubt_sessions')->after('virtual_classroom');
            $table->boolean('online_test_series')->after('doubt_sessions');
            $table->boolean('mentor_sessions')->after('online_test_series');
            $table->boolean('choice_of_faculty')->after('mentor_sessions');
            $table->boolean('study_material')->after('choice_of_faculty');
            $table->boolean('resource_library')->after('study_material');
            $table->boolean('assessment')->after('resource_library');
            $table->boolean('admission_counselling')->after('assessment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('institute_files_data', function (Blueprint $table) {
            $table->dropColumn('sunday');
            $table->dropColumn('sunday_open');
            $table->dropColumn('sunday_close');
            $table->dropColumn('monday');
            $table->dropColumn('monday_open');
            $table->dropColumn('monday_close');
            $table->dropColumn('tuesday');
            $table->dropColumn('tuesday_open');
            $table->dropColumn('tuesday_close');
            $table->dropColumn('wednesday');
            $table->dropColumn('wednesday_open');
            $table->dropColumn('wednesday_close');
            $table->dropColumn('thursday');
            $table->dropColumn('thursday_open');
            $table->dropColumn('thursday_close');
            $table->dropColumn('friday');
            $table->dropColumn('friday_open');
            $table->dropColumn('friday_close');
            $table->dropColumn('saturday');
            $table->dropColumn('saturday_open');
            $table->dropColumn('saturday_close');
            $table->text('founded');
            $table->dropColumn('batch_training');
            $table->dropColumn('personalised_training');
            $table->dropColumn('virtual_classroom');
            $table->dropColumn('doubt_sessions');
            $table->dropColumn('online_test_series');
            $table->dropColumn('mentor_sessions');
            $table->dropColumn('choice_of_faculty');
            $table->dropColumn('study_material');
            $table->dropColumn('resource_library');
            $table->dropColumn('assessment');
            $table->dropColumn('admission_counselling');
        });
    }
};
