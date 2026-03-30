<?php

namespace Modules\Institute\Providers;

use App\Models\Institute;
use App\Models\Institute\Information\Alumni;
use App\Models\Institute\Information\Center;
use App\Models\Institute\Information\Champions;
use App\Models\Institute\Information\Course;
use App\Models\Institute\Information\Faculty;
use App\Models\Institute\Information\Video;
use App\Models\Institute\InstituteStream;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Institute\Policies\Information\AlumniPolicy;
use Modules\Institute\Policies\Information\CenterPolicy;
use Modules\Institute\Policies\Information\ChampionsPolicy;
use Modules\Institute\Policies\Information\CoursePolicy;
use Modules\Institute\Policies\Information\FacultyPolicy;
use Modules\Institute\Policies\Information\VideoPolicy;
use Modules\Institute\Policies\Institute\InstituteStreamPolicy;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Alumni::class                   => AlumniPolicy::class,
        Center::class                   => CenterPolicy::class,
        Champions::class                => ChampionsPolicy::class,
        Faculty::class                  => FacultyPolicy::class,
        Video::class                    => VideoPolicy::class,
        Course::class                   => CoursePolicy::class,
        InstituteStream::class          => InstituteStreamPolicy::class,
    ];



    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-center', function () {
            $institute =  Institute::findOrFail(session()->get('institute.id'));
            return $institute->package->no_of_centers > $institute->centers->count();
        });

        Gate::define('create-stream', [InstituteStreamPolicy::class, 'create']);
        Gate::define('create-course', [CoursePolicy::class, 'create']);

        Gate::define('show-enroll', function () {
            $institute =  Institute::findOrFail(session()->get('institute.id'));
            if ($institute->package->is_course_enrollment == true) {
                return true;
            } else {
                false;
            }
        });
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
