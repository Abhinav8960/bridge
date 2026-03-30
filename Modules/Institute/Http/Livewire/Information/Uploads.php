<?php

namespace Modules\Institute\Http\Livewire\Information;

use App\Models\Institute\Information\GalleryImages;
use App\Models\Institute\Information\Uploads as InformationUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Uploads extends Component
{
    use WithFileUploads;

    public $model;

    public $user_id;
    public $institute_id;
    public $logo;
    public $leaderboard;
    public $corporateBrochure;
    public $images;
    public $submitButton;
    public $image_dir = 'images/institute/information/uploads';
    public $maxGalleryFileUpload = 10;
    public $captions;
    public $alt;
    public $flashmsg;
    public $gallerydeleteId;

    public function mount()
    {
        $this->model =  InformationUploads::where('institute_id', session()->get('institute.id'))->first();
        if (empty($this->model)) {
            $this->model = new InformationUploads();
        } else {
            if ($this->model->images->count() > 0) {
                foreach ($this->model->images as $images) {
                    $this->captions[$images->id] = $images->caption;
                    $this->alt[$images->id] = $images->alt;
                }
            }
        }

        $this->user_id = Auth::user()->id;
        $this->UploadCount();
    }

    public function render()
    {
        return view('institute::livewire.information.uploads');
    }

    public function updatedLogo($propertyName)
    {
        $this->validate([
            'logo'                 => 'image|dimensions:width=400,height=400|mimes:jpeg|max:100',
        ]);

        $filename = 'logo_' . date('dmyHis') . '.' . $this->logo->getClientOriginalExtension();

        $this->deleteFromStorage($this->model->logo);

        $value =  $this->fileupload($this->image_dir . '/logo', $this->logo, $filename);
        session()->flash('success', 'Logo is uploaded successfully');
        $this->upsertNow('logo', $value);
    }

    public function updatedLeaderboard($propertyName)
    {
        $this->validate([
            'leaderboard'                  => 'image|dimensions:width=1550,height=300|mimes:jpeg|max:100',
        ]);

        $filename = 'leaderboard_' . date('dmyHis') . '.' . $this->leaderboard->getClientOriginalExtension();
        $this->deleteFromStorage($this->model->leaderboard);

        $value =  $this->fileupload($this->image_dir . '/leaderboard', $this->leaderboard, $filename);
        session()->flash('success', 'Leaderboard is uploaded successfully');
        $this->upsertNow('leaderboard', $value);
    }


    public function updatedCorporateBrochure($propertyName)
    {
        $this->validate([
            'corporateBrochure'                  => 'file|mimes:pdf|max:10240',
        ]);
        $filename = 'institute-corporate-brochure_' . date('dmyHis') . '.' . $this->corporateBrochure->getClientOriginalExtension();
        $this->deleteFromStorage($this->model->corporate_brochure);

        $value =  $this->fileupload($this->image_dir . '/corporate-brochure', $this->corporateBrochure, $filename);
        session()->flash('success', 'Corporate Brochure is uploaded successfully');
        $this->upsertNow('corporate_brochure', $value);
    }

    public function updatedImages($propertyName)
    {
        $this->validate([
            'images'                    => 'max:' . $this->maxGalleryFileUpload,
            'images.*'                  => 'image|dimensions:width=600,height=600|mimes:jpeg',
        ], [
            'images.max' => 'The images must be less than or equal to ' . $this->maxGalleryFileUpload . ' files now, and maximum 10',
            'images.*.image' => 'Only Image file can be upload',
            'images.*.dimensions' => 'Image dimensions should be 600 pixels x 600 pixels.',
            'images.*.mimes' => 'Image File should be jpeg Format'
        ]);

        $value_arr = [];
        $i=0;
        foreach ($this->images as $image) {

            $filename = 'institute-gallery-image_' . \Carbon\Carbon::now()->addSeconds($i)->format('dmyHis') . '.' . $image->getClientOriginalExtension();

            $value_arr[]['image'] =  $this->fileupload($this->image_dir . '/gallery-image', $image, $filename);
            $i++;
        }
        $this->storeGallery($value_arr);
        session()->flash('success', 'Gallery is uploaded successfully');
    }

    protected $messages = [
        'logo.dimensions' => 'The :attribute dimension should be 100 pixels x 100 pixels.',
        'leaderboard.dimensions' => 'The :attribute dimension should be 1550 pixels x 300 pixels.',
    ];

    public function storeGallery($value_arr)
    {
        if (empty($this->model->id)) {
            $this->upsertNow('logo', NULL);
        }
        if (is_array($value_arr) && !empty($value_arr)) {
            // dd(gettype($value_arr));
            $this->model->images()->createMany($value_arr);
        }
        $this->updatedModel();
    }

    public function upsertNow($fieldName, $value)
    {
        InformationUploads::updateOrCreate(
            ['institute_id' => session()->get('institute.id')],
            [$fieldName => $value]
        );
        $this->updatedModel();
    }

    public function fileupload($dir, $file, $filename)
    {

        return $file->storeAs($dir, $filename, ['disk' => 'public']);
    }

    public function updatedModel()
    {
        $this->model =  InformationUploads::where('institute_id', session()->get('institute.id'))->first();
        if (empty($this->model)) {
            $this->model = new InformationUploads();
        }
    }

    public function UploadCount()
    {
        if (!empty($this->model->id)) {
            $this->model->images()->count();

            if ($this->maxGalleryFileUpload > $this->model->images()->count()) {
                $this->maxGalleryFileUpload = $this->maxGalleryFileUpload - $this->model->images()->count();
            } else {
                $this->maxGalleryFileUpload = 0;
            }
        }
    }

    public function updatedCaptions($propertyName)
    {
        foreach ($this->captions as $key => $caption) {
            $gallery = GalleryImages::where('id', $key)->first();
            $gallery->caption = $caption;
            $gallery->update();
        }
        $this->flashmsg = "Caption Updated Successfully";
    }

    public function updatedAlt($propertyName)
    {
        foreach ($this->alt as $key => $alt) {
            $gallery = GalleryImages::where('id', $key)->first();
            $gallery->alt = $alt;
            $gallery->update();
        }
        $this->flashmsg = "Alt Updated Successfully";
    }

    public function flashReset()
    {
        $this->flashmsg = NULL;
    }

    public function deleteId($id)
    {
        $this->gallerydeleteId = $id;
    }

    public function delete()
    {
        $gallery = GalleryImages::where('id', $this->gallerydeleteId)->first();
        $this->deleteFromStorage($gallery->image);
        $gallery->delete();
        $this->altUpdatedFlash = NULL;
        $this->flashmsg = "Images Deleted Successfully";
        return redirect()->route('information.uploads');
    }

    private function deleteFromStorage($path)
    {
        if (!empty($path)) {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        return;
    }
}
