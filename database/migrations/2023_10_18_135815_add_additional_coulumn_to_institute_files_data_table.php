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

            $table->string('institute_email_1')->after('duration');
            $table->string('institute_email_2')->after('institute_email_1');
            $table->string('institute_phone_type_1')->after('institute_email_2');
            $table->string('institute_phone_number_1')->after('institute_phone_type_1');
            $table->string('institute_phone_type_2')->after('institute_phone_number_1');
            $table->string('institute_phone_number_2')->after('institute_phone_type_2');
            $table->longtext('leadership_description')->nullable()->after('leadership_designation');

            $table->string('branch_name')->after('institute_phone_number_2');
            $table->string('branch_head')->after('branch_name');
            $table->string('branch_email_1')->after('branch_head');
            $table->string('branch_email_2')->after('branch_email_1');
            $table->string('branch_phone_type_1')->after('branch_email_2');
            $table->string('branch_phone_number_1')->after('branch_phone_type_1');
            $table->string('branch_phone_type_2')->after('branch_phone_number_1');
            $table->string('branch_phone_number_2')->after('branch_phone_type_2');

            $table->string('facebook_url')->after('branch_phone_number_2');
            $table->string('instagram_url')->after('facebook_url');
            $table->string('youtube_url')->after('instagram_url');
            $table->string('linkedin_url')->after('youtube_url');
            $table->string('twitter_url')->after('linkedin_url');
            $table->string('branch_address')->after('twitter_url');
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
            $table->dropColumn('institute_email_1');
            $table->dropColumn('institute_email_2');
            $table->dropColumn('institute_phone_type_1');
            $table->dropColumn('institute_phone_number_1');
            $table->dropColumn('institute_phone_type_2');
            $table->dropColumn('institute_phone_number_2');
            $table->dropColumn('leadership_description');
            $table->dropColumn('branch_name');
            $table->dropColumn('branch_head');
            $table->dropColumn('branch_email_1');
            $table->dropColumn('branch_email_2');
            $table->dropColumn('branch_phone_type_1');
            $table->dropColumn('branch_phone_number_1');
            $table->dropColumn('branch_phone_type_2');
            $table->dropColumn('branch_phone_number_2');
            $table->dropColumn('facebook_url');
            $table->dropColumn('instagram_url');
            $table->dropColumn('youtube_url');
            $table->dropColumn('linkedin_url');
            $table->dropColumn('twitter_url');
            $table->dropColumn('branch_address');
            $table->dropColumn('api_message');       
         });
    }
};
