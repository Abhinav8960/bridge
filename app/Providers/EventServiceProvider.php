<?php

namespace App\Providers;

use App\Models\Institute;
use App\Observers\Backend\Configuration\CategoryObserver;
use App\Observers\Backend\Configuration\StreamObserver;
use App\Observers\Backend\InstituteObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute\Information\Faculty;
use App\Models\PaymentInstamojoRequest;
use App\Observers\Institute\Information\FacultyObserver;
use App\Observers\PaymentInstamojoRequestObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(CategoryObserver::class);
        Stream::observe(StreamObserver::class);
        Institute::observe(InstituteObserver::class);
        PaymentInstamojoRequest::observe(PaymentInstamojoRequestObserver::class);
        // Faculty::observe(FacultyObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
