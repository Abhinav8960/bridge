<?php

namespace Modules\Backend\Http\Livewire\Configuration\CallToAction;

use App\Models\Backend\Configuration\CallToAction;
use Livewire\Component;

class Form extends Component
{
    public $model;

    public $callToActionType;
    public $specifyValue;
    public $is_showin_header;
    public $is_showin_footer;
    public $is_showin_contact_page;
    public $is_showin_mobile_app;

    public $showHeader;
    public $showFooter;
    public $showContactPage;
    public $showMobile;


    public function mount()
    {
        $this->callToActionType = $this->model->call_to_action_type;
        $this->specifyValue = $this->model->specify_value;
        $this->checkforOptions();
        $this->is_showin_header = $this->model->is_showin_header;
        $this->is_showin_footer = $this->model->is_showin_footer;
        $this->is_showin_contact_page = $this->model->is_showin_contact_page;
        $this->is_showin_mobile_app = $this->model->is_showin_mobile_app;
    }

    public function render()
    {
        return view('backend::livewire.configuration.call-to-action.form');
    }

    public function rules()
    {
        $rules = [];
        $rules['callToActionType']        = 'required|integer';
        if (!empty($this->callToActionType == 1)) {
            $rules['specifyValue']            = 'required|email|unique:call_to_actions,specify_value';
        } else {
            $rules['specifyValue']            = 'required|integer|unique:call_to_actions,specify_value';
        }


        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedCallToActionType($callToActionType)
    {
        $this->checkforOptions();
    }

    public function checkforOptions()
    {
            $this->showHeader = 1;
            $this->showFooter = 1;
            $this->showContactPage = 1;
            $this->showMobile = 1;

        if (!empty($this->model->id)) {
            $actionheader = CallToAction::where([['status', true], ['call_to_action_type', $this->callToActionType], ['id', '!=', $this->model->id]])->get();
        } elseif (!empty($this->callToActionType)) {
            $actionheader = CallToAction::where([['status', true], ['call_to_action_type', $this->callToActionType]])->get();
        }
        if (!empty($actionheader)) {
            foreach($actionheader as $CToA){
                if($CToA->is_showin_header == 1){
                    $this->showHeader = 0;
                }
                if($CToA->is_showin_footer == 1){
                    $this->showFooter = 0;
                }
                if($CToA->is_showin_contact_page == 1){
                    $this->showContactPage = 0;
                }
                if($CToA->is_showin_mobile_app == 1){
                    $this->showMobile = 0;
                }
            }
        }
    }
}
