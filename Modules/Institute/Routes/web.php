<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('institutes')->group(function () {

    Route::get('loginvendor', '\Modules\Institute\Http\Controllers\Auth\LoginController@showLoginForm')->name('institute.login');
    Route::post('loginvendor', '\Modules\Institute\Http\Controllers\Auth\LoginController@login');

    // Registration Routes...
    Route::get('register', '\Modules\Institute\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('institute.register');
    Route::post('register', '\Modules\Institute\Http\Controllers\Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', '\Modules\Institute\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', '\Modules\Institute\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', '\Modules\Institute\Http\Controllers\Auth\ResetPasswordController@showResetForm');
    Route::post('password/reset', '\Modules\Institute\Http\Controllers\Auth\ResetPasswordController@reset');
    Route::get('/{user}/login-from-admin/{isAdmin}/{admin}', '\Modules\Institute\Http\Controllers\InstituteController@login')->name('institute.loginwithAdmin');


    Route::post('logout', '\Modules\Institute\Http\Controllers\Auth\LoginController@logout')->name('institute.logout');
    Route::middleware(['Vendor'])->group(function () {

        Route::get('/{user}/back-to-admin/{isAdmin}', '\Modules\Institute\Http\Controllers\InstituteController@backToAdmin')->name('institute.backToAdmin');
        Route::get('/', '\Modules\Institute\Http\Controllers\InstituteController@index')->name('institute.public');
        Route::get('/reviews', '\Modules\Institute\Http\Controllers\InstituteReviewController@index')->name('institute.reviews');
        Route::get('/leads', '\Modules\Institute\Http\Controllers\InstituteReviewController@leads')->name('institute.leads');
        Route::get('/enrollments', '\Modules\Institute\Http\Controllers\InstituteController@enrollment')->name('institute.enrollment');

        Route::resource('/streams', \Modules\Institute\Http\Controllers\InstituteStreamController::class)->only([
            'index', 'show',  'create', 'store',  'edit', 'update'
        ])->names([
            'index'         => 'institute.streams.index',
            'show'          => 'institute.streams.show',
            'create'        => 'institute.streams.create',
            'store'         => 'institute.streams.store',
            'edit'          => 'institute.streams.edit',
            'update'        => 'institute.streams.update',
            // 'destroy'       => 'institute.streams.destroy'
        ]);
    });
    Route::middleware('Vendor')->resource('/center', \Modules\Institute\Http\Controllers\Information\CenterController::class)->only([
        'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
    ])->names([
        'index'         => 'center.index',
        'show'          => 'center.show',
        'create'        => 'center.create',
        'store'         => 'center.store',
        'edit'          => 'center.edit',
        'update'        => 'center.update',
        'destroy'       => 'center.destroy'
    ]);
    Route::middleware(['Vendor'])->prefix('information')->as('information.')->group(function () {


        Route::get('/publish', '\Modules\Institute\Http\Controllers\Information\PublishController@index')->name('publish.index');

        Route::get('/uploads', '\Modules\Institute\Http\Controllers\Information\UploadsController@uploads')->name('uploads');
        Route::get('/general', '\Modules\Institute\Http\Controllers\Information\GeneralController@general')->name('general');
        Route::get('/champions', '\Modules\Institute\Http\Controllers\Information\ChampionsController@champions')->name('champions');

        Route::middleware('TabAccessable:is_showing_champions')->resource('/champions', \Modules\Institute\Http\Controllers\Information\ChampionsController::class)->only([
            'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
        ])->names([
            'index'         => 'champions.index',
            'show'          => 'champions.show',
            'create'        => 'champions.create',
            'store'         => 'champions.store',
            'edit'          => 'champions.edit',
            'update'        => 'champions.update',
            'destroy'       => 'champions.destroy'
        ]);
        Route::resource('/faculty', \Modules\Institute\Http\Controllers\Information\FacultyController::class)->only([
            'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
        ])->names([
            'index'         => 'faculty.index',
            'show'          => 'faculty.show',
            'create'        => 'faculty.create',
            'store'         => 'faculty.store',
            'edit'          => 'faculty.edit',
            'update'        => 'faculty.update',
            'destroy'       => 'faculty.destroy'
        ]);


        Route::resource('/alumni', \Modules\Institute\Http\Controllers\Information\AlumniController::class)->only([
            'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
        ])->names([
            'index'         => 'alumni.index',
            'show'          => 'alumni.show',
            'create'        => 'alumni.create',
            'store'         => 'alumni.store',
            'edit'          => 'alumni.edit',
            'update'        => 'alumni.update',
            'destroy'       => 'alumni.destroy'
        ]);
        Route::resource('/video', \Modules\Institute\Http\Controllers\Information\VideoController::class)->only([
            'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
        ])->names([
            'index'         => 'video.index',
            'show'          => 'video.show',
            'create'        => 'video.create',
            'store'         => 'video.store',
            'edit'          => 'video.edit',
            'update'        => 'video.update',
            'destroy'       => 'video.destroy'
        ]);
        Route::resource('/course', \Modules\Institute\Http\Controllers\Information\CourseController::class)->only([
            'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
        ])->names([
            'index'         => 'course.index',
            'show'          => 'course.show',
            'create'        => 'course.create',
            'store'         => 'course.store',
            'edit'          => 'course.edit',
            'update'        => 'course.update',
            'destroy'       => 'course.destroy'
        ]);
    });
});
