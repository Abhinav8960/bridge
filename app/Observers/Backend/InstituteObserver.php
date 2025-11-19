<?php

namespace App\Observers\Backend;

use App\Models\Backend\InstitutePackageHistory;
use App\Models\Institute;
use App\Models\Institute\Information\GalleryImages;
use App\Models\Institute\Information\Uploads;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class InstituteObserver
{
    private static $deleted_at = null;
    /**
     * Handle the Institute "created" event.
     *
     * @param  app\models\Institute  $institute
     * @return void
     */
    public function created(Institute $institute)
    {

        if ($institute->wasChanged('package_id') || $institute->wasChanged('duration')) {
            $this->updateplanhistory($institute);
        }

        $random = rand(100000, 999999);


        $user = new User();
        $user->name = $institute->name;
        $user->password = Hash::make($random);
        $user->email = $institute->email;
        $user->actual_password = $random;
        $user->phone = $institute->mobile;
        $user->role_id = User::ROLE_VENDOR;
        $user->save();

        $institute->user_id = $user->id;
        $institute->update();
    }

    /**
     * Handle the Institute "updated" event.
     *
     * @param  app\models\Institute  $institute
     * @return void
     */
    public function updated(Institute $institute)
    {
        $user = User::findOrFail($institute->user_id);
        $user->name = $institute->name;
        // $user->password = Hash::make('password');
        $user->email = $institute->email;
        $user->phone = $institute->mobile;
        $user->role_id = User::ROLE_VENDOR;
        $user->update();

        if ($institute->wasChanged('package_id') || $institute->wasChanged('duration')) {
            $this->updateplanhistory($institute);
        }
    }

    /**
     * Handle the Institute "deleted" event.
     *
     * @param  app\models\Institute  $institute
     * @return void
     */
    public function deleted(Institute $institute)
    {
        $uploads_id = Uploads::where('institute_id', $institute->id)->first();

        if (!empty($uploads_id->logo)) {
            if (Storage::disk('public')->exists($uploads_id->logo)) {
                Storage::disk('public')->delete($uploads_id->logo);
            }
        } elseif (!empty($uploads_id->leaderboard)) {
            if (Storage::disk('public')->exists($uploads_id->leaderboard)) {
                Storage::disk('public')->delete($uploads_id->leaderboard);
            }
        } elseif (!empty($uploads_id->corporate_brochure)) {
            if (Storage::disk('public')->exists($uploads_id->corporate_brochure)) {
                Storage::disk('public')->delete($uploads_id->corporate_brochure);
            }
        }
        if (!empty($uploads_id)) {
            $gallery = GalleryImages::where('uploads_id', $uploads_id->id)->get();
            if (!empty($gallery)) {
                DB::table('gallery_images')
                    ->where('uploads_id', $uploads_id->id)
                    ->delete();
                foreach ($gallery as $gallery) {
                    if (!empty($gallery->image)) {

                        if (Storage::disk('public')->exists($gallery->image)) {
                            Storage::disk('public')->delete($gallery->image);
                        }
                    }
                }
            }
        }

        $institute->user()->forceDelete();
        $institute->feature()->forceDelete();
        $institute->centers()->forceDelete();
        $institute->packagehistory()->forceDelete();
        $institute->instituteexam()->forceDelete();
        $institute->courses()->forceDelete();
        $institute->vidoes()->forceDelete();
        $institute->upload()->forceDelete();
        $institute->general()->forceDelete();
        $institute->champions()->forceDelete();
        $institute->streams()->forceDelete();
        $institute->corporateoffice()->forceDelete();
        $institute->vidoes()->forceDelete();
        $institute->alumnis()->forceDelete();
        if (!empty($institute->netrating()) > 0) {
            $institute->netrating()->forceDelete();
        }
        $institute->leaderboard()->forceDelete();
        $institute->streamexam()->forceDelete();
    }

    /**
     * Handle the Institute "restored" event.
     *
     * @param  app\models\Institute  $institute
     * @return void
     */
    public function restored(Institute $institute)
    {
        //
    }

    /**
     * Handle the Institute "force deleted" event.
     *
     * @param  \App\Models\Institute  $institute
     * @return void
     */
    public function forceDeleted(Institute $institute)
    {
        $uploads_id = Uploads::where('institute_id', $institute->id)->first();

        if (!empty($uploads_id->logo)) {
            if (Storage::disk('public')->exists($uploads_id->logo)) {
                Storage::disk('public')->delete($uploads_id->logo);
            }
        } elseif (!empty($uploads_id->leaderboard)) {
            if (Storage::disk('public')->exists($uploads_id->leaderboard)) {
                Storage::disk('public')->delete($uploads_id->leaderboard);
            }
        } elseif (!empty($uploads_id->corporate_brochure)) {
            if (Storage::disk('public')->exists($uploads_id->corporate_brochure)) {
                Storage::disk('public')->delete($uploads_id->corporate_brochure);
            }
        }
        if (!empty($uploads_id)) {
            $gallery = GalleryImages::where('uploads_id', $uploads_id->id)->get();
            if (!empty($gallery)) {
                DB::table('gallery_images')
                    ->where('uploads_id', $uploads_id->id)
                    ->delete();
                foreach ($gallery as $gallery) {
                    if (!empty($gallery->image)) {

                        if (Storage::disk('public')->exists($gallery->image)) {
                            Storage::disk('public')->delete($gallery->image);
                        }
                    }
                }
            }
        }

        $institute->user()->forceDelete();
        $institute->feature()->forceDelete();
        $institute->centers()->forceDelete();
        $institute->packagehistory()->forceDelete();
        $institute->instituteexam()->forceDelete();
        $institute->courses()->forceDelete();
        $institute->vidoes()->forceDelete();
        $institute->upload()->forceDelete();
        $institute->general()->forceDelete();
        $institute->champions()->forceDelete();
        $institute->streams()->forceDelete();
        $institute->corporateoffice()->forceDelete();
        $institute->vidoes()->forceDelete();
        $institute->alumnis()->forceDelete();
        $institute->leaderboard()->forceDelete();
        $institute->streamexam()->forceDelete();
        if (!empty($institute->netrating()) > 0) {
            $institute->netrating()->forceDelete();
        }
    }


    private function updateplanhistory($institute)
    {
        $model = new InstitutePackageHistory();
        $model->institute_id            = $institute->id;
        $model->package_id              = $institute->package_id;
        $model->duration                = $institute->duration;
        $model->package_valid_from         = $institute->plan_valid_from;
        $model->package_valid_upto         = $institute->plan_valid_upto;
        $model->save();
    }
}
