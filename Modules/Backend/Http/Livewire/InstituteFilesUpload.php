<?php

namespace Modules\Backend\Http\Livewire;

use App\Models\InstituteFiles;
use Livewire\Component;
use Livewire\WithFileUploads;

class InstituteFilesUpload extends Component
{
    use WithFileUploads;

    public $file;
    public $typeOptions = [1 => 'Institute', 2 => 'Institute Streams'];
    public $type;
    public $dir = "files/institute/csv";

    public function render()
    {
        return view('backend::livewire.institute-files-upload');
    }

    public function rules()
    {
        $rules = [];
        $rules['file']                  = 'required|file|mimes:csv,txt';
        $rules['type']                  = 'required';
        return $rules;
    }

    public function save()
    {

        $this->validate();
        $uplaodedfilename = $this->file->getClientOriginalName();
        $expo = explode(".", $uplaodedfilename);
        $extention = end($expo);
        $filename = 'institute_bulk_upload_' . \Carbon\Carbon::now()->format('dmyHis') . '.' . $extention;
        $this->file->storeAs($this->dir, $filename, ['disk' => 'public']);
        $fullpath = $this->dir . '/' . $filename;
        $fp = file(public_path() . '/storage/' . $fullpath, FILE_SKIP_EMPTY_LINES);

        $model = new InstituteFiles();
        $model->type = $this->type;
        $model->filename = $uplaodedfilename;
        $model->file_path = $fullpath;
        $model->total_record = count($fp) - 1;
        $model->save();


        if ($this->type == 1) {

            $table = (new \App\Models\InstituteFilesData)->getTable();
            $pdo = \DB::connection()->getPdo();

            $pdo->exec('LOAD DATA LOCAL INFILE "' . public_path() . '/storage/' . $fullpath . '" IGNORE 
                            INTO TABLE ' . $table . ' 
                            FIELDS TERMINATED BY "," 
                            OPTIONALLY ENCLOSED BY "\""
                            LINES TERMINATED BY "\\n" 
                            IGNORE 1 LINES 
                            (@column1,@column2,@column3,@column4,@column5,@column6,@column7,@column8,@column9,@column10,@column11,@column12,@column13,@column14,@column15,@column16,@column17,@column18,@column19,@column20,@column21,@column22,@column23,@column24,@column25,@column26,@column27,@column28,@column29,@column30,@column31,@column32,@column33,@column34,@column35,@column36,@column37,@column38,@column39,@column40,@column41,@column42,@column43,@column44,@column45,@column46,@column47,@column48,@column49,@column50,@column51,@column52,@column53,@column54,@column55,@column56,@column57,@column58,@column59,@column60,@column61,@column62,@column63,@column64,@column65,@column66,@column67,@column68,@column69,@column70,@column71) 
                            SET institute_files_id                      =   ' . $model->id . ',
                            name	                                    =   @column1,
                            authorized_person                           =   @column2,
                            email                                       =   @column3,
                            mobile                                      =   @column4,
                            country_id                                  =   @column5,
                            state_id                                    =   @column6,
                            city_id                                     =   @column7,
                            area_id                                     =   @column8,
                            google_institute_address                    =   @column9,
                            latitude                                    =   @column10,
                            longitude                                   =   @column11,
                            website                                     =   @column12,
                            description                                 =   @column13,
                            leadership_name                             =   @column14,
                            leadership_designation                      =   @column15,
                            leadership_description                      =   @column16,
                            duration                                    =   @column17,
                            institute_email_1                           =   @column18,
                            institute_email_2                           =   @column19,
                            institute_phone_type_1                      =   @column20,
                            institute_phone_number_1                    =   @column21,
                            institute_phone_type_2                      =   @column22,
                            institute_phone_number_2                    =   @column23,
                            branch_name                                 =   @column24,
                            branch_head                                 =   @column25,
                            branch_email_1                              =   @column26,
                            branch_email_2                              =   @column27,
                            branch_phone_type_1                         =   @column28,
                            branch_phone_number_1                       =   @column29,
                            branch_phone_type_2                         =   @column30,
                            branch_phone_number_2                       =   @column31,
                            facebook_url                                =   @column32,
                            instagram_url                               =   @column33,
                            youtube_url                                 =   @column34,
                            linkedin_url                                =   @column35,
                            twitter_url                                 =   @column36,
                            branch_address                              =   @column37,
                            is_recommended                              =   @column38,
                            sunday                                      =   @column39,
                            sunday_open                                 =   @column40,
                            sunday_close                                =   @column41,
                            monday                                      =   @column42,
                            monday_open                                 =   @column43,
                            monday_close                                =   @column44,
                            tuesday                                     =   @column45,
                            tuesday_open                                =   @column46,
                            tuesday_close                               =   @column47,
                            wednesday                                   =   @column48,
                            wednesday_open                              =   @column49,
                            wednesday_close                             =   @column50,
                            thursday                                    =   @column51,
                            thursday_open                               =   @column52,
                            thursday_close                              =   @column53,
                            friday                                      =   @column54,
                            friday_open                                 =   @column55,
                            friday_close                                =   @column56,
                            saturday                                    =   @column57,
                            saturday_open                               =   @column58,
                            saturday_close                              =   @column59,
                            founded                                     =   @column60,
                            batch_training                              =   @column61,
                            personalised_training                       =   @column62,
                            virtual_classroom                           =   @column63,
                            doubt_sessions                              =   @column64,
                            online_test_series                          =   @column65,
                            mentor_sessions                             =   @column66,
                            choice_of_faculty                           =   @column67,
                            study_material                              =   @column68,
                            resource_library                            =   @column69,
                            assessment                                  =   @column70,
                            admission_counselling                       =   @column71

                        ');
        }
        if ($this->type == 2) {
            $table = (new \App\Models\InstituteStreamExamFilesData)->getTable();
            $pdo = \DB::connection()->getPdo();

            $pdo->exec('LOAD DATA LOCAL INFILE "' . public_path() . '/storage/' . $fullpath . '" IGNORE 
                            INTO TABLE ' . $table . ' 
                            FIELDS TERMINATED BY "," 
                            OPTIONALLY ENCLOSED BY "\""
                            LINES TERMINATED BY "\\n" 
                            IGNORE 1 LINES 
                            (@column1,@column2,@column3,@column4) 
                            SET institute_files_id      =   ' . $model->id . ',
                            institute_id	            =   @column1,
                            category_id                 =   @column2,
                            stream_id                   =   @column3,
                            exam_id                     =   @column4
                            
                        ');
        }


        return redirect()->route('institute.bulk.index');
    }
}
