<?php

namespace App\Console\Commands;

use App\Helpers\LocationHelper;
use App\Helpers\SmsHelper;
use App\Models\Backend\Packages;
use App\Models\Institute;
use App\Models\Institute\Information\Center;
use App\Models\Institute\Information\General;
use App\Models\Institute\Information\InstituteFeature;
use App\Models\Institute\InstituteStream;
use App\Models\InstituteFiles;
use App\Models\InstituteFilesData;
use App\Models\InstituteStreamExam;
use App\Models\InstituteStreamExamFilesData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class IntituteBulkCreateCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'IntituteBulkCreate:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Intitute (Lite Package Create)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $migration_runing = InstituteFiles::where('is_migration_runing', true)->count();

        if ($migration_runing < 1) {
            $institutefile = InstituteFiles::where('is_migration_runing', false)->where('is_migrated', false)->first();
            if (!empty($institutefile)) {
                
                $institutefile->is_migration_runing = true;
                $institutefile->save();
                if ($institutefile->type == InstituteFiles::FILE_TYPE_INSTITUTE) {
                    $ins_file_data = InstituteFilesData::where('institute_files_id', $institutefile->id)->where('is_migrated', false)->get();
                    foreach ($ins_file_data as $data) {

                        $d = [];
                        foreach ($data->toArray() as $key => $arr) {
                            $d[$key] = $arr;
                        }

                        if (!empty($d)) {
                            $validator =  Validator::make($d, [
                                'name'                          => 'required|string',
                                'authorized_person'             => 'required|string',
                                'email'                         => 'required|email',
                                'mobile'                        => 'required|unique:users,phone|regex:/^([0-9\s\-\+\(\)]*)$/',
                                'country_id'                    => 'required|integer',
                                'state_id'                      => 'required|integer',
                                'city_id'                       => 'required|integer',
                                'google_institute_address'      => 'required|string',
                                'latitude'                      => 'required|string',
                                'longitude'                     => 'required|string',
                                'website'                       => 'required|string',
                                'description'                   => 'required|string',
                                'leadership_name'               => 'bail|nullable|string',
                                'leadership_designation'        => 'bail|nullable|string',
                                'leadership_description'        => 'bail|nullable|string',
                                'duration'                      => 'required|integer',
                                'institute_email_1'             => 'required|email',
                                'institute_email_2 ? '             => 'bail|nullable|email',
                                'institute_phone_type_1'        => 'required|string',
                                'institute_phone_number_1'      => 'required|integer',
                                'institute_phone_type_2'        => 'bail|nullable|string',
                                'institute_phone_number_2'      => 'bail|nullable|integer',
                                'branch_name'                   => 'required|string',
                                'branch_head'                   => 'required|string',
                                'branch_email_1'                => 'required|email',
                                'branch_email_2 '                => 'bail|nullable|email',
                                'branch_phone_type_1'           => 'required|string',
                                'branch_phone_number_1'         => 'required|integer',
                                'branch_phone_type_2'           => 'bail|nullable|string',
                                'branch_phone_number_2'         => 'bail|nullable|integer',
                                'facebook_url'                  => 'bail|nullable|url',
                                'instagram_url'                 => 'bail|nullable|url',
                                'youtube_url'                   => 'bail|nullable|url',
                                'linkedin_url'                  => 'bail|nullable|url',
                                'twitter_url'                   => 'bail|nullable|url',
                                'branch_address'                => 'required|string',
                                'is_recommended'                => 'required|integer',
                                'is_recommended'                => 'required|integer',
                                'sunday'                        => 'required|boolean',
                                'sunday_open'                   => 'bail|nullable|date_format:H:i:s',
                                'sunday_close'                  => 'bail|nullable|date_format:H:i:s',
                                'monday'                        => 'required|boolean',
                                'monday_open'                   => 'bail|nullable|date_format:H:i:s',
                                'monday_close'                  => 'bail|nullable|date_format:H:i:s',
                                'tuesday'                       => 'required|boolean',
                                'tuesday_open'                  => 'bail|nullable|date_format:H:i:s',
                                'tuesday_close'                 => 'bail|nullable|date_format:H:i:s',
                                'wednesday'                     => 'required|boolean',
                                'wednesday_open'                => 'bail|nullable|date_format:H:i:s',
                                'wednesday_close'               => 'bail|nullable|date_format:H:i:s',
                                'thursday'                      => 'required|boolean',
                                'thursday_open'                 => 'bail|nullable|date_format:H:i:s',
                                'thursday_close'                => 'bail|nullable|date_format:H:i:s',
                                'friday'                        => 'required|boolean',
                                'friday_open'                   => 'bail|nullable|date_format:H:i:s',
                                'friday_close'                  => 'bail|nullable|date_format:H:i:s',
                                'saturday'                      => 'required|boolean',
                                'saturday_open'                 => 'bail|nullable|date_format:H:i:s',
                                'saturday_close'                => 'bail|nullable|date_format:H:i:s',
                                'founded'                       => 'required|string',
                                'batch_training'                => 'required|boolean',
                                'personalised_training'         => 'required|boolean',
                                'virtual_classroom'             => 'required|boolean',
                                'doubt_sessions'                => 'required|boolean',
                                'online_test_series'            => 'required|boolean',
                                'mentor_sessions'               => 'required|boolean',
                                'choice_of_faculty'             => 'required|boolean',
                                'study_material'                => 'required|boolean',
                                'resource_library'              => 'required|boolean',
                                'assessment'                    => 'required|boolean',
                                'admission_counselling'         => 'required|boolean'


                            ]);
                            if ($validator->fails()) {
                                $data->any_error = json_encode($validator->errors());
                                $data->is_cron_run = true;
                                $data->save();
                            } else {
                                $institute = new Institute();
                                $package = Packages::where('id', Packages::LITE_PACKAGE)->first();
                                try {
                                    $countryId = $data->country_id;
                                    $stateId = $data->state_id;
                                    $cityId = $data->city_id;

                                    $institute->name = $data->name;
                                    $institute->authorized_person = $data->authorized_person;
                                    $institute->email = $data->email;
                                    $institute->mobile = $data->mobile;
                                    $institute->country_id = $countryId;
                                    $institute->country_name = LocationHelper::getCountryName($countryId);
                                    $institute->country_code = LocationHelper::getCountryCode($countryId);
                                    $institute->state_id = $stateId;
                                    $institute->state_name = LocationHelper::getStateName($stateId);
                                    $institute->city_id = $cityId;
                                    $institute->city_name = LocationHelper::getCityName($stateId, $cityId);
                                    $institute->area = LocationHelper::getAreaName($stateId, $cityId, $data->area_id);
                                    $institute->area_id = $data->area_id;
                                    $institute->pincode = LocationHelper::getPincode($stateId, $cityId, $data->area_id);
                                    $institute->package_id = Packages::LITE_PACKAGE;
                                    $institute->duration = $data->duration;
                                    $institute->plan_valid_from = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                                    $institute->plan_valid_upto = \Carbon\Carbon::now()->addMonths($data->duration);
                                    $institute->is_showing_general = $package->is_showing_general;
                                    $institute->is_showing_courses = $package->is_showing_courses;
                                    $institute->is_showing_champions = $package->is_showing_champions;
                                    $institute->is_showing_uploads = $package->is_showing_uploads;
                                    $institute->is_showing_faculty = $package->is_showing_faculty;
                                    $institute->is_showing_centers = $package->is_showing_centers;
                                    $institute->is_showing_videos = $package->is_showing_videos;
                                    $institute->is_showing_alumni = $package->is_showing_alumni;
                                    $institute->google_institute_address = $data->google_institute_address;
                                    $institute->latitude = $data->latitude;
                                    $institute->longitude = $data->longitude;
                                    $institute->is_recommended = $data->is_recommended;
                                    $institute->save();
                                    $this->saveGeneral($institute, $data);
                                    $this->saveCenter($institute, $data);
                                    $this->saveFeatures($institute, $data);
                                    $data->is_migrated = true;
                                    $data->is_cron_run = true;
                                    $data->any_error = NULL;
                                    $data->save();
                                } catch (\Exception $e) {
                                    // return $e->getMessage();
                                    $data->any_error = $e->getMessage();
                                 
                                    $data->save();
                                }
                            }
                        }
                    }
                } elseif ($institutefile->type == InstituteFiles::FILE_TYPE_STREAM) {
                    $ins_file_data_insti = InstituteStreamExamFilesData::where('institute_files_id', $institutefile->id)->where('is_migrated', false)->where('is_cron_run', false)->groupBy('institute_id')->get();
                    if (!empty($ins_file_data_insti)) {

                        foreach ($ins_file_data_insti as $insti) {

                            $ins_file_data_category = InstituteStreamExamFilesData::where('institute_id', $insti->institute_id)->where('is_migrated', false)->where('is_cron_run', false)->get()->groupBy('category_id');


                            if (!empty($ins_file_data_category)) {

                                $inst = Institute::where('id', $insti->institute_id)->first();

                                if (!empty($inst)) {
                                    $category_ids = [];
                                    foreach ($ins_file_data_category->toArray() as $key => $cat) {
                                        $category_ids[] = $key;
                                    }
                                    $no_of_streams =  $inst->package->no_of_streams;
                                    $no_of_streams_exist =  $inst->uniquecategorystreams()->whereNotIn('category_id', $category_ids)->count();

                                    $no_of_streams_trying_to_upload =  $ins_file_data_category->count();
                                    $total_streams = $no_of_streams_exist + $no_of_streams_trying_to_upload;
                                    // dd($no_of_streams, $no_of_streams_exist, $no_of_streams_trying_to_upload, $total_streams);

                                    if ($no_of_streams < $total_streams) {


                                        InstituteStreamExamFilesData::where('institute_id', $insti->institute_id)->whereIn('category_id', $category_ids)->update([
                                            'any_error' => json_encode(['category_id' => "More than 1 Category id tring to upload"]),
                                            'is_cron_run' => true,
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                    // dd('hjk');

                    $ins_file_data = InstituteStreamExamFilesData::where('institute_files_id', $institutefile->id)->where('is_migrated', false)->where('is_cron_run', false)->get();

                    foreach ($ins_file_data as $data) {
                        $d = [];
                        foreach ($data->toArray() as $key => $arr) {
                            $d[$key] = $arr;
                        }
                        // dd($d);
                        if (!empty($d)) {
                            $validator =  Validator::make($d, [
                                'institute_id'                          => 'required|exists:\App\Models\Institute,id',
                                'category_id'                           => 'required|exists:\App\Models\Backend\Configuration\Category,id',
                                // 'stream_id'                             => 'required|exists:\App\Models\Backend\Configuration\Stream,id',
                                'stream_id'                             => 'required|exists:\App\Models\Backend\Configuration\Exam,stream_id,category_id,' . $d['category_id'],
                                // 'exam_id'                               => 'required|exists:\App\Models\Backend\Configuration\Exam,id',
                                'exam_id'                               => 'required|exists:\App\Models\Backend\Configuration\Exam,id,stream_id,' . $d['stream_id'],
                            ]);

                            if ($validator->fails()) {
                                $data->any_error = json_encode($validator->errors());
                                $data->is_cron_run = true;
                                $data->save();
                            } else {

                                $instituteStream = InstituteStream::firstOrCreate([
                                    'institute_id' => $data->institute_id,
                                    'category_id' => $data->category_id,
                                    'stream_id' => $data->stream_id,
                                ], [
                                    'institute_id' => $data->institute_id,
                                    'category_id' => $data->category_id,
                                    'stream_id' => $data->stream_id,
                                ]);

                                $instituteStream = InstituteStreamExam::firstOrCreate([
                                    'institute_stream_id' => $instituteStream->id,
                                    'institute_id' => $data->institute_id,
                                    'category_id' => $data->category_id,
                                    'stream_id' => $data->stream_id,
                                    'exam_id' => $data->exam_id,
                                ], [
                                    'institute_stream_id' => $instituteStream->id,
                                    'institute_id' => $data->institute_id,
                                    'category_id' => $data->category_id,
                                    'stream_id' => $data->stream_id,
                                    'exam_id' => $data->exam_id,
                                ]);


                                $data->is_migrated = true;
                                $data->is_cron_run = true;
                                $data->any_error = NULL;
                                $data->save();
                            }
                        }
                    }
                }


                $institutefile->is_migrated = true;
                $institutefile->is_migration_runing = false;
                $institutefile->save();
            }
        }







        return Command::SUCCESS;
    }

    private function saveGeneral($institute, $data)
    {
        $general  = new General();
        $general->created_by =  false;
        $general->institute_id                          = $institute->id;
        $general->website                               = $data->website;
        $general->description                           = $data->description;
        $general->email_1                               = $data->institute_email_1;
        $general->email_2                               = $data->institute_email_2 ? $data->institute_email_2 : NULL;
        $general->phone_type_1                          = $data->institute_phone_type_1;
        $general->phone_number_1                        = $data->institute_phone_number_1;
        $general->phone_type_2                          = $data->institute_phone_type_2 ? $data->institute_phone_type_2 : NULL;
        $general->phone_number_2                        = $data->institute_phone_number_2;
        // $general->admission_screening               = $data->admissionScreening;
        // $general->admission_screening_url           = $data->admissionScreeningUrl;
        // $general->admission_screening_description   = $data->admissionScreeningDescription;
        // $general->admission_screening_image         = ($data->admissionScreeningImage) ? $url1 : $data->model->admission_screening_image;
        // $general->mock_test                         = $data->mockTest;
        // $general->mock_test_url                     = $data->mockTestUrl;
        // $general->mock_test_description             = $data->mockTestDescription;
        // $general->mock_test_image                   = ($data->mockTestImage) ? $url2 : $data->model->mock_test_image;
        $general->leadership_name                   = !empty($data->leadership_name) ? $data->leadership_name : NULL;
        $general->leadership_designation            = !empty($data->leadership_designation) ? $data->leadership_designation : NULL;
        $general->leadership_description            = !empty($data->leadership_description) ? $data->leadership_description : NULL;
        $general->save();
        return true;
    }

    private function saveCenter($institute, $data)
    {
        $centers = new Center();
        $centers->created_by =  false;

        $countryId = $data->country_id;
        $stateId = $data->state_id;
        $cityId = $data->city_id;

        $centers->institute_id = $institute->id;
        $centers->branch_name = $data->branch_name;
        $centers->center_head = $data->branch_head;
        $centers->branch_type = Center::CORPORATE_HEADQUARTER;

        $centers->google_business_address = $data->google_institute_address;
        $centers->latitude = $data->latitude;
        $centers->longitude = $data->longitude;

        $centers->address =  $data->branch_address;
        $centers->country_id = $countryId;
        $centers->country_name = LocationHelper::getCountryName($countryId);
        $centers->country_code = LocationHelper::getCountryCode($countryId);
        $centers->state_id = $stateId;
        $centers->state_name = LocationHelper::getStateName($stateId);
        $centers->city_id = $cityId;
        $centers->city_name = LocationHelper::getCityName($stateId, $cityId);
        $centers->area = LocationHelper::getAreaName($stateId, $cityId, $data->area_id);
        $centers->area_id = $data->area_id;
        $centers->pincode = LocationHelper::getPincode($stateId, $cityId, $data->area_id);
        $centers->email_1 = $data->branch_email_1;
        $centers->email_2 = $data->branch_email_2 ? $data->branch_email_2 : NULL;
        $centers->phone_type_1 = strtolower($data->branch_phone_type_1) == 'mobile' ? 1 : 2;
        $centers->phone_number_1 = $data->branch_phone_number_1;
        $centers->phone_type_2 = strtolower($data->branch_phone_type_2)  == 'mobile' ? 1 : 2;
        $centers->phone_number_2 = $data->branch_phone_number_2 ? $data->branch_phone_number_2 : NULL;
        // 
        $centers->facebook_url = $data->facebook_url;
        $centers->instagram_url = $data->instagram_url;
        $centers->youtube_url = $data->youtube_url;
        $centers->linkedin_url = $data->linkedin_url;
        $centers->twitter_url = $data->twitter_url;

        $centers->sunday = $data->sunday;
        $centers->sunday_open = $data->sunday_open;
        $centers->sunday_close = $data->sunday_close;

        $centers->monday = $data->monday;
        $centers->monday_open = $data->monday_open;
        $centers->monday_close = $data->monday_close;


        $centers->tuesday = $data->tuesday;
        $centers->tuesday_open = $data->tuesday_open;
        $centers->tuesday_close = $data->tuesday_close;

        $centers->wednesday = $data->wednesday;
        $centers->wednesday_open = $data->wednesday_open;
        $centers->wednesday_close = $data->wednesday_close;

        $centers->thursday = $data->thursday;
        $centers->thursday_open = $data->thursday_open;
        $centers->thursday_close = $data->thursday_close;

        $centers->friday = $data->friday;
        $centers->friday_open = $data->friday_open;
        $centers->friday_close = $data->friday_close;

        $centers->saturday = $data->saturday;
        $centers->saturday_open = $data->saturday_open;
        $centers->saturday_close = $data->saturday_close;


        $centers->save();
        return true;
    }


    private function saveFeatures($institute, $data)
    {

        $model = new InstituteFeature();
        $model->institute_id = $institute->id;
        $model->features_id = InstituteFeature::Founded;
        $model->value = $data->founded ?? NULL;
        $model->save();

        $model = new InstituteFeature();
        $model->institute_id = $institute->id;
        $model->features_id = InstituteFeature::Batch_Training;
        $model->value = $data->batch_training == 1 ? 1 : 0;
        $model->save();

        $model = new InstituteFeature();
        $model->institute_id = $institute->id;
        $model->features_id = InstituteFeature::Personalised_Training;
        $model->value = $data->personalised_training == 1 ? 1 : 0;
        $model->save();

        $model = new InstituteFeature();
        $model->institute_id = $institute->id;
        $model->features_id = InstituteFeature::Virtual_Classroom;
        $model->value = $data->virtual_classroom == 1 ? 1 : 0;
        $model->save();

        $model = new InstituteFeature();
        $model->institute_id = $institute->id;
        $model->features_id = InstituteFeature::Doubt_Sessions;
        $model->value = $data->doubt_sessions == 1 ? 1 : 0;
        $model->save();


        $model = new InstituteFeature();
        $model->institute_id = $institute->id;
        $model->features_id = InstituteFeature::Online_Test_Series;
        $model->value = $data->online_test_series == 1 ? 1 : 0;
        $model->save();

        $model = new InstituteFeature();
        $model->institute_id = $institute->id;
        $model->features_id = InstituteFeature::Mentor_Sessions;
        $model->value = $data->mentor_sessions == 1 ? 1 : 0;
        $model->save();

        $model = new InstituteFeature();
        $model->institute_id = $institute->id;
        $model->features_id = InstituteFeature::Choice_of_Faculty;
        $model->value = $data->choice_of_faculty == 1 ? 1 : 0;
        $model->save();

        $model = new InstituteFeature();
        $model->institute_id = $institute->id;
        $model->features_id = InstituteFeature::Study_Material;
        $model->value = $data->study_material == 1 ? 1 : 0;
        $model->save();

        $model = new InstituteFeature();
        $model->institute_id = $institute->id;
        $model->features_id = InstituteFeature::Resource_Library;
        $model->value = $data->resource_library == 1 ? 1 : 0;
        $model->save();

        $model = new InstituteFeature();
        $model->institute_id = $institute->id;
        $model->features_id = InstituteFeature::Assessment;
        $model->value = $data->assessment == 1 ? 1 : 0;
        $model->save();

        $model = new InstituteFeature();
        $model->institute_id = $institute->id;
        $model->features_id = InstituteFeature::Admission_Counselling;
        $model->value = $data->admission_counselling == 1 ? 1 : 0;
        $model->save();
    }
}
