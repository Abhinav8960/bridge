<?php

namespace App\Observers\Institute\Information;

use App\Models\Institute\Information\Faculty;
use App\Models\Institute\Information\FacultySubject;

class FacultyObserver
{
    /**
     * Handle the faculty "created" event.
     *
     * @param  \App\Models\faculty  $faculty
     * @return void
     */
    public function created(Faculty $faculty)
    {
         FacultySubject::updateOrCreate([
           
            'subject'   => strtolower($faculty->subject),
        ],[
            'subject'   => strtolower($faculty->subject),

        ]);

    }

    /**
     * Handle the faculty "updated" event.
     *
     * @param  \App\Models\faculty  $faculty
     * @return void
     */
    public function updated(faculty $faculty)
    {
        FacultySubject::updateOrCreate([
           
            'subject'   => strtolower($faculty->subject),
        ],[
            'subject'   => strtolower($faculty->subject),

        ]);
    }

    /**
     * Handle the faculty "deleted" event.
     *
     * @param  \App\Models\faculty  $faculty
     * @return void
     */
    public function deleted(faculty $faculty)
    {
        //
    }

    /**
     * Handle the faculty "restored" event.
     *
     * @param  \App\Models\faculty  $faculty
     * @return void
     */
    public function restored(faculty $faculty)
    {
        //
    }

    /**
     * Handle the faculty "force deleted" event.
     *
     * @param  \App\Models\faculty  $faculty
     * @return void
     */
    public function forceDeleted(faculty $faculty)
    {
        //
    }
}
