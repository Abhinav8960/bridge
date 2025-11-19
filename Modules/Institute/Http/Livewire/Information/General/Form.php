<?php

namespace Modules\Institute\Http\Livewire\Information\General;

use App\Models\Institute\Information\General;
use App\Models\Institute\Information\InstituteFeature;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Rules\MaxWordsRule;
use Livewire\WithFileUploads;
use App\Models\Backend\Configuration\Feature;
use Illuminate\Validation\Rule;


class Form extends Component
{
    use WithFileUploads;

    public $inputTypeSelect = Feature::INPUT_TYPE_SELECT;
    public $inputTypeText = Feature::INPUT_TYPE_TEXT;
    public $model;
    public $institute_id;
    public $description;
    public $website;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $email1;
    public $email2;
    public $phoneType1;
    public $phoneType2;
    public $phoneNumber1;
    public $phoneNumber2;
    public $admissionScreening = false;
    public $admissionScreeningUrl;
    public $admissionScreeningDescription;
    public $admissionScreeningImage;
    public $mockTest = false;
    public $mockTestUrl;
    public $mockTestDescription;
    public $mockTestImage;
    public $leadershipName;
    public $leadershipDesignation;
    public $leadershipImage;
    public $leadership_description;
    public $phoneTypeOptions;
    public $isAdmissionScreening = false;
    public $isMockTest = false;
    public $image_dir = 'images/institute/information/general';
    public $featuresOptions;
    public $YesNOOptions = [1 => 'Yes', 0 => 'NO'];
    public $feature = [];
    public $institutesFeatures;


    public function mount()
    {
        $this->featuresOptions = Feature::where('status', true)->get();

        foreach ($this->featuresOptions as $option) {
            if ($option->field_type != $this->inputTypeText) {
                $this->feature[$option->id] = 0;
            }
        }


        $institutesFeatures = InstituteFeature::where('institute_id', session()->get('institute.id'))->where('status', true)->get();
        if (!empty($institutesFeatures)) {
            foreach ($institutesFeatures as $institutesFeature) {
                $this->feature[$institutesFeature->features_id] = $institutesFeature->value;
            }
        }


        $this->phoneTypeOptions = [
            'Mobile' => 'Mobile',
            'Landline' => 'Landline',
        ];
        $this->updatedModel();

        $this->featuresOptions = Feature::where('status', true)->get();



        if (!empty($this->model->id)) {

            $this->website = $this->model->website;
            $this->description = $this->model->description;
            $this->meta_title = $this->model->meta_title;
            $this->meta_description = $this->model->meta_description;
            $this->meta_keywords = $this->model->meta_keywords;
            $this->email1 = $this->model->email_1;
            $this->email2 = $this->model->email_2;
            $this->phoneType1 = $this->model->phone_type_1;
            $this->phoneType2 = $this->model->phone_type_2;
            $this->phoneNumber1 = $this->model->phone_number_1;
            $this->phoneNumber2 = ($this->model->phone_number_2 > 0) ? $this->model->phone_number_2 : '';
            $this->admissionScreening = ($this->model->admission_screening) ? $this->model->admission_screening : false;
            $this->isAdmissionScreening = $this->admissionScreening;

            $this->admissionScreeningUrl = $this->model->admission_screening_url;
            $this->admissionScreeningDescription = $this->model->admission_screening_description;
            $this->mockTest = ($this->model->mock_test) ? $this->model->mock_test : false;
            $this->isMockTest = $this->mockTest;
            $this->mockTestUrl = $this->model->mock_test_url;
            $this->mockTestDescription = $this->model->mock_test_description;
            $this->leadershipName = $this->model->leadership_name;
            $this->leadershipDesignation = $this->model->leadership_designation;
            $this->leadership_description = $this->model->leadership_description;
        }
    }

    public function render()
    {
        return view('institute::livewire.information.general.form');
    }

    public function rules()
    {
        $rules = [];

        // if (!empty($this->description)) {
        //     $rules['description'] = new MaxWordsRule(150);
        // }
        $rules['website'] = 'required|url';
        // $rules['meta_title'] = 'required';
        $rules['email1'] = 'required|email';
        $rules['phoneType1'] = 'required';
        // $rules['phoneNumber1'] = 'required|unique:generals,phone_number_1|required_with:institute_id|integer';
        $rules['phoneNumber1'] = [
            'required',
            Rule::unique('generals', 'phone_number_1')
                ->ignore($this->model->id)
                ->where(function ($query) {
                    return $query->where('institute_id', session()->get('institute.id'));
                }),
        ];
        if (!empty($this->email2)) {

            $rules['email2'] = 'required|unique:generals,email_1|email|different:email1';
        }
        if (!empty($this->phoneNumber2)) {
            // $rules['phoneNumber2'] = 'required|unique:generals,phone_number_2,' . session()->get('institute.id') . ',institute_id|integer|different:phoneNumber1';
            $rules['phoneNumber2'] = [
                'different:phoneNumber1',
                Rule::unique('generals', 'phone_number_2')
                    ->ignore($this->model->id)
                    ->where(function ($query) {
                        return $query->where('institute_id', session()->get('institute.id'));
                    }),
            ];
        }

        $rules["admissionScreening"] = "boolean";
        if ($this->admissionScreening == true) {
            $rules["admissionScreeningUrl"] = 'bail|required_if:admissionScreening,==,true|url';
            $rules["admissionScreeningDescription"] = 'bail|required_if:admissionScreening,==,true|string';
            if (!empty($this->admissionScreeningDescription)) {
                $rules['admissionScreeningDescription'] = new MaxWordsRule(15);
            }
            if (!empty($this->admissionScreeningImage)) {
                $rules["admissionScreeningImage"] = 'bail|required_if:admissionScreening,==,true|dimensions:width=770,height=360|mimes:jpeg|max:100';
            }
        }
        $rules["mockTest"] = "boolean";
        if ($this->mockTest == true) {
            $rules["mockTestUrl"] = 'bail|required_if:mockTest,==,true';
            $rules["mockTestDescription"] = 'bail|required_if:mockTest,==,true';
            if (!empty($this->mockTestDescription)) {
                $rules['mockTestDescription'] = new MaxWordsRule(15);
            }
            if (!empty($this->mockTestImage)) {
                $rules["mockTestImage"] = 'bail|required_if:mockTest,==,true|dimensions:width=770,height=360|mimes:jpeg|max:100';
            }
        }
        if (!empty($this->leadershipName) || !empty($this->leadershipImage) || !empty($this->leadershipDesignation) || !empty($this->leadership_description)) {

            // $rules['leadershipImage']        = 'dimensions:width=300,height=300|mimes:jpeg|max:100';
            $rules['leadershipName']   = 'required|string';
            $rules['leadershipDesignation']   = 'required|string';
            $rules['leadership_description']   = 'required|string';
            // if (!empty($this->leadership_description)) {
            //     $rules['leadership_description'] = new MaxWordsRule(150);
            // }
        }

        return $rules;
    }

    protected $messages = [
        'admissionScreeningImage.dimensions' => 'The :attribute dimension should be 770 pixels x 360 pixels.',
        'mockTestImage.dimensions' => 'The :attribute dimension should be 770 pixels x 360 pixels.',
        'leadershipImage.dimensions' => 'The :attribute dimension should be 300 pixels x 300 pixels.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function updatedAdmissionScreening($admissionScreening)
    {
        if ($admissionScreening == true) {
            $this->isAdmissionScreening = true;
        } else {
            $this->isAdmissionScreening = false;
            // $this->reset('admissionScreeningUrl');
        }
    }

    public function updatedMockTest($mockTest)
    {
        if ($mockTest == true) {
            $this->isMockTest = true;
        } else {
            $this->isMockTest = false;
            // $this->reset('mockTestUrl');

        }
    }

    public function save()
    {
        $this->validate();
        if (!empty($this->admissionScreeningImage)) {
            $filename = 'institute-general-admission-screening-image_' . date('dmyHis') . '.' . $this->admissionScreeningImage->getClientOriginalExtension();
            $url1 =  $this->fileupload($this->image_dir . '/admission-screening-image', $this->admissionScreeningImage, $filename);
        }
        if (!empty($this->mockTestImage)) {
            $filename = 'institute-general-mock-test-image_' . date('dmyHis') . '.' . $this->mockTestImage->getClientOriginalExtension();
            $url2 =  $this->fileupload($this->image_dir . '/mock-test-image', $this->mockTestImage, $filename);
        }
        if (!empty($this->leadershipImage)) {
            $filename = 'institute-general-leadership-image_' . date('dmyHis') . '.' . $this->leadershipImage->getClientOriginalExtension();
            $url =  $this->fileupload($this->image_dir . '/leadership-image', $this->leadershipImage, $filename);
        }

        General::updateOrCreate(
            ['institute_id' => session()->get('institute.id')],
            [
                'website'                           => $this->website,
                'description'                       => $this->description,
                'meta_title'                           => $this->meta_title,
                'meta_description'                           => $this->meta_description,
                'meta_keywords'                           => $this->meta_keywords,
                'email_1'                           => $this->email1,
                'email_2'                           => $this->email2,
                'phone_type_1'                      => $this->phoneType1,
                'phone_number_1'                    => $this->phoneNumber1,
                'phone_type_2'                      => $this->phoneType2,
                'phone_number_2'                    => $this->phoneNumber2,
                'admission_screening'               => $this->admissionScreening,
                'admission_screening_url'           => $this->admissionScreeningUrl,
                'admission_screening_description'   => $this->admissionScreeningDescription,
                'admission_screening_image'         => ($this->admissionScreeningImage) ? $url1 : $this->model->admission_screening_image,
                'mock_test'                         => $this->mockTest,
                'mock_test_url'                     => $this->mockTestUrl,
                'mock_test_description'             => $this->mockTestDescription,
                'mock_test_image'                   => ($this->mockTestImage) ? $url2 : $this->model->mock_test_image,
                'leadership_name'                   => $this->leadershipName,
                'leadership_designation'            => $this->leadershipDesignation,
                'leadership_image'                  => ($this->leadershipImage) ? $url : $this->model->leadership_image,
                'leadership_description'            => $this->leadership_description,
            ]
        );
        $this->storeFeatures($this->feature);
        session()->flash('success', 'General Information is added successfully');
        $this->updatedModel();
    }

    public function storeFeatures($feature)
    {
        foreach ($feature as $key => $value) {

            InstituteFeature::updateOrCreate(
                [
                    'institute_id' => session()->get('institute.id'),
                    'features_id' => $key,
                ],
                [
                    'institute_id'                  => session()->get('institute.id'),
                    'features_id'                   => $key,
                    'value'                         => $value,

                ]
            );
        }
    }

    public function fileupload($dir, $file, $filename)
    {

        return $file->storeAs($dir, $filename, ['disk' => 'public']);
    }

    public function updatedModel()
    {
        $this->model =  General::where('institute_id', session()->get('institute.id'))->first();
        if (empty($this->model)) {
            $this->model = new General();
        }
    }
}
