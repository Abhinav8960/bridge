<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Modules\Backend\Http\Controllers\AjaxController;
use Modules\Backend\Http\Controllers\BackendController;

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

Route::prefix('public')->group(function () {


    Route::get('loginadmin', '\Modules\Backend\Http\Controllers\Auth\LoginController@showLoginForm')->name('backend.login');
    Route::get('{user}/loginnow', '\Modules\Backend\Http\Controllers\Auth\LoginController@loginAsAdmin')->name('backend.login.asAdmin');
    Route::post('loginadmin', '\Modules\Backend\Http\Controllers\Auth\LoginController@login');

    // Registration Routes...
    Route::get('register', '\Modules\Backend\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('backend.register');
    Route::post('register', '\Modules\Backend\Http\Controllers\Auth\RegisterController@register');


    Route::get('password/reset', 'Modules\Backend\Http\Controllers\Auth\ForgotPasswordController@showForgetPasswordForm')->name('backend.password.request');
    Route::post('password/reset', 'Modules\Backend\Http\Controllers\Auth\ForgotPasswordController@sendOtp')->name('backend.password.send.otp');
    // Route::get('logout', '\Modules\Backend\Http\Controllers\Auth\LoginController@logout')->name('backend.logout');


    Route::middleware('role:' . User::ROLE_ADMIN . ',' . User::ROLE_BlOGGER . ',' .  User::ROLE_SEEDER . ',' . User::ROLE_MANAGER)->group(function () {

        Route::get('/', 'BackendController@index')->name('backend.public');
        Route::post('logout', '\Modules\Backend\Http\Controllers\Auth\LoginController@logout')->name('backend.logout');

        Route::prefix('search')->as('search.')->group(function () {
            Route::get('state/{state}/city', [AjaxController::class, 'fetchCity'])->name('fetchCity');
            Route::get('state/{state}/city/{city}/area/all', [AjaxController::class, 'fetchAllArea'])->name('fetchAllArea');
        });

        Route::middleware('role:' . User::ROLE_ADMIN . ',' . User::ROLE_MANAGER)->group(function () {

            Route::prefix('leads')->as('leads.')->group(function () {
                Route::get('/contact/list', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.list');
                Route::get('/enroll/list', [Modules\Backend\Http\Controllers\BackendController::class, 'enroll'])->name('enroll.list');
            });

            Route::prefix('payment')->as('payment.')->group(function () {

                Route::resource('/tax', Modules\Backend\Http\Controllers\TaxController::class)->only([
                    'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
                ])->names([
                    'index'         => 'tax.index',
                    'show'          => 'tax.show',
                    'create'        => 'tax.create',
                    'store'         => 'tax.store',
                    'edit'          => 'tax.edit',
                    'update'        => 'tax.update',
                    'destroy'       => 'tax.destroy'
                ]);
                Route::resource('/saccode', Modules\Backend\Http\Controllers\SacCodeController::class)->only([
                    'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
                ])->names([
                    'index'         => 'saccode.index',
                    'show'          => 'saccode.show',
                    'create'        => 'saccode.create',
                    'store'         => 'saccode.store',
                    'edit'          => 'saccode.edit',
                    'update'        => 'saccode.update',
                    'destroy'       => 'saccode.destroy'
                ]);
                Route::resource('/billingaccount', Modules\Backend\Http\Controllers\BillingAccountController::class)->only([
                    'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
                ])->names([
                    'index'         => 'billingaccount.index',
                    'show'          => 'billingaccount.show',
                    'create'        => 'billingaccount.create',
                    'store'         => 'billingaccount.store',
                    'edit'          => 'billingaccount.edit',
                    'update'        => 'billingaccount.update',
                    'destroy'       => 'billingaccount.destroy',
                ]);


                Route::get('/success', [Modules\Backend\Http\Controllers\PaymentReportController::class, 'success'])->name('report.success');
                Route::get('/failed', [Modules\Backend\Http\Controllers\PaymentReportController::class, 'failure'])->name('report.failed');
                Route::get('/refunded', [Modules\Backend\Http\Controllers\PaymentReportController::class, 'refunded'])->name('report.refund');
                Route::post('/refund/{payment_id}', [Modules\Backend\Http\Controllers\PaymentReportController::class, 'refundnow'])->name('refund');
            });


            Route::resource('/internal-user-registration', \Modules\Backend\Http\Controllers\Configuration\UserRegistrationController::class)->only([
                'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
            ])->names([
                'index'         => 'userregistration.index',
                'show'          => 'userregistration.show',
                'create'        => 'userregistration.create',
                'store'         => 'userregistration.store',
                'edit'          => 'userregistration.edit',
                'update'        => 'userregistration.update',
                'destroy'       => 'userregistration.destroy'
            ])->middleware('role:' . User::ROLE_ADMIN);

            // spotlite

            Route::resource('/spotlites', \Modules\Backend\Http\Controllers\SpotliteController::class)->only([
                'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
            ])->names([
                'index'         => 'spotlites.index',
                'show'          => 'spotlites.show',
                'create'        => 'spotlites.create',
                'store'         => 'spotlites.store',
                'edit'          => 'spotlites.edit',
                'update'        => 'spotlites.update',
                'destroy'       => 'spotlites.destroy'
            ])->middleware('role:' . User::ROLE_ADMIN);

            Route::get('/internal-user-registration/publish/{user}', [\Modules\Backend\Http\Controllers\Configuration\UserRegistrationController::class, 'publish'])->name('userregistration.publish')->middleware('role:' . User::ROLE_ADMIN);

            Route::get('/enrollments', [Modules\Backend\Http\Controllers\BackendController::class, 'enrollments'])->name('enrollments');


            Route::prefix('configuration')->as('configuration.')->group(function () {
                Route::resource('/category', \Modules\Backend\Http\Controllers\Configuration\CategoryController::class)->only([
                    'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
                ])->names([
                    'index'         => 'category.index',
                    'show'          => 'category.show',
                    'create'        => 'category.create',
                    'store'         => 'category.store',
                    'edit'          => 'category.edit',
                    'update'        => 'category.update',
                    'destroy'       => 'category.destroy'
                ]);

                Route::resource('/parameter', \Modules\Backend\Http\Controllers\Configuration\ParametersController::class)->only([
                    'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
                ])->names([
                    'index'         => 'parameter.index',
                    'show'          => 'parameter.show',
                    'create'        => 'parameter.create',
                    'store'         => 'parameter.store',
                    'edit'          => 'parameter.edit',
                    'update'        => 'parameter.update',
                    'destroy'       => 'parameter.destroy'
                ]);

                Route::resource('/stream', \Modules\Backend\Http\Controllers\Configuration\StreamController::class)->only([
                    'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
                ])->names([
                    'index'         => 'stream.index',
                    'show'          => 'stream.show',
                    'create'        => 'stream.create',
                    'store'         => 'stream.store',
                    'edit'          => 'stream.edit',
                    'update'        => 'stream.update',
                    'destroy'       => 'stream.destroy'
                ]);
                Route::prefix('search')->group(function () {
                    Route::get('stream', [AjaxController::class, 'fetchStream'])->name('fetchStream');
                });
                Route::resource('/exam', \Modules\Backend\Http\Controllers\Configuration\ExamController::class)->only([
                    'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
                ])->names([
                    'index'         => 'exam.index',
                    'show'          => 'exam.show',
                    'create'        => 'exam.create',
                    'store'         => 'exam.store',
                    'edit'          => 'exam.edit',
                    'update'        => 'exam.update',
                    'destroy'       => 'exam.destroy'
                ]);
                Route::resource('/institute-feature', \Modules\Backend\Http\Controllers\Configuration\FeatureController::class)->only([
                    'index', 'show',  'create', 'store',  'edit', 'update'
                ])->names([
                    'index'         => 'feature.index',
                    'show'          => 'feature.show',
                    'create'        => 'feature.create',
                    'store'         => 'feature.store',
                    'edit'          => 'feature.edit',
                    'update'        => 'feature.update',
                ]);
                Route::resource('/call-to-action', \Modules\Backend\Http\Controllers\Configuration\CallToActionController::class)->only([
                    'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
                ])->names([
                    'index'         => 'calltoaction.index',
                    'show'          => 'calltoaction.show',
                    'create'        => 'calltoaction.create',
                    'store'         => 'calltoaction.store',
                    'edit'          => 'calltoaction.edit',
                    'update'        => 'calltoaction.update',
                    'destroy'       => 'calltoaction.destroy'
                ]);
                Route::resource('/faq-category', \Modules\Backend\Http\Controllers\Configuration\FaqCategoryController::class)->only([
                    'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
                ])->names([
                    'index'         => 'faqcategory.index',
                    'show'          => 'faqcategory.show',
                    'create'        => 'faqcategory.create',
                    'store'         => 'faqcategory.store',
                    'edit'          => 'faqcategory.edit',
                    'update'        => 'faqcategory.update',
                    'destroy'       => 'faqcategory.destroy'
                ]);
                Route::resource('/faq', \Modules\Backend\Http\Controllers\Configuration\FaqController::class)->only([
                    'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
                ])->names([
                    'index'         => 'faq.index',
                    'show'          => 'faq.show',
                    'create'        => 'faq.create',
                    'store'         => 'faq.store',
                    'edit'          => 'faq.edit',
                    'update'        => 'faq.update',
                    'destroy'       => 'faq.destroy'
                ]);
                Route::resource('/privacy-policy', \Modules\Backend\Http\Controllers\Configuration\PrivacyPolicyController::class)->only([
                    'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
                ])->names([
                    'index'         => 'privacypolicy.index',
                    'show'          => 'privacypolicy.show',
                    'create'        => 'privacypolicy.create',
                    'store'         => 'privacypolicy.store',
                    'edit'          => 'privacypolicy.edit',
                    'update'        => 'privacypolicy.update',
                    'destroy'       => 'privacypolicy.destroy'
                ]);
                Route::resource('/term-and-use', \Modules\Backend\Http\Controllers\Configuration\TermAndUseController::class)->only([
                    'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
                ])->names([
                    'index'         => 'termanduse.index',
                    'show'          => 'termanduse.show',
                    'create'        => 'termanduse.create',
                    'store'         => 'termanduse.store',
                    'edit'          => 'termanduse.edit',
                    'update'        => 'termanduse.update',
                    'destroy'       => 'termanduse.destroy'
                ]);
            });



            Route::resource('/popular-cities', \Modules\Backend\Http\Controllers\PopularCityController::class)->only([
                'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
            ])->names([
                'index'         => 'popularcity.index',
                'show'          => 'popularcity.show',
                'create'        => 'popularcity.create',
                'store'         => 'popularcity.store',
                'edit'          => 'popularcity.edit',
                'update'        => 'popularcity.update',
                'destroy'       => 'popularcity.destroy'
            ]);
        });


        Route::middleware('role:' . User::ROLE_ADMIN)->group(function () {

            Route::resource('/packages', \Modules\Backend\Http\Controllers\PackagesController::class)->only([
                'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
            ])->names([
                'index'         => 'packages.index',
                'show'          => 'packages.show',
                'create'        => 'packages.create',
                'store'         => 'packages.store',
                'edit'          => 'packages.edit',
                'update'        => 'packages.update',
                'destroy'       => 'packages.destroy'
            ]);

            Route::resource('/students', \Modules\Backend\Http\Controllers\StudentController::class)->only([
                'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
            ])->names([
                'index'         => 'students.index',
                'show'          => 'students.show',
                'create'        => 'students.create',
                'store'         => 'students.store',
                'edit'          => 'students.edit',
                'update'        => 'students.update',
                'destroy'       => 'students.destroy'
            ]);
            Route::get('/students/publish/{students}', [\Modules\Backend\Http\Controllers\StudentController::class, 'publish'])->name('students.publish');


            Route::get('/sms/log', [\Modules\Backend\Http\Controllers\SmsController::class, 'index'])->name('sms.log');

        });


        Route::middleware('role:' . User::ROLE_ADMIN . ',' . User::ROLE_SEEDER . ',' . User::ROLE_MANAGER)->group(function () {

            Route::resource('/institute', \Modules\Backend\Http\Controllers\InstituteController::class)->only([
                'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
            ])->names([
                'index'         => 'institute.index',
                'show'          => 'institute.show',
                'create'        => 'institute.create',
                'store'         => 'institute.store',
                'edit'          => 'institute.edit',
                'update'        => 'institute.update',
                'destroy'       => 'institute.destroy'
            ])->except(['show']);


            Route::get('/institute/bulk/upload-file-download', [\Modules\Backend\Http\Controllers\InstituteFilesController::class, 'institutesampledownload'])->name('institute.bulk.upload-file-download');
            Route::get('/institute/bulk/upload-file-institute-stream-download', [\Modules\Backend\Http\Controllers\InstituteFilesController::class, 'institutestreamsampledownload'])->name('institute.bulk.upload-file-institute-stream-download');
            Route::resource('/institute/bulk', \Modules\Backend\Http\Controllers\InstituteFilesController::class)->only([
                'index', 'show',  'create', 'store',
            ])->names([
                'index'         => 'institute.bulk.index',
                'show'          => 'institute.bulk.show',
            ]);



            Route::get('institute/{id}/package-history', [\Modules\Backend\Http\Controllers\InstituteController::class, 'packagehistory'])->name('institute.packagehistory');
            Route::post('institute/{id}/package-upgrade', [\Modules\Backend\Http\Controllers\InstituteController::class, 'packageupgrade'])->name('institute.packageupgrade');


            Route::resource('/institute-feature', \Modules\Backend\Http\Controllers\InstituteListFeatureController::class)->only([
                'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
            ])->names([
                'index'         => 'institute.feature.index',
                'show'          => 'institute.feature.show',
                'create'        => 'institute.feature.create',
                'store'         => 'institute.feature.store',
                'edit'          => 'institute.feature.edit',
                'update'        => 'institute.feature.update',
                'destroy'       => 'institute.feature.destroy'
            ]);


            Route::resource('/institute-leaderboard', \Modules\Backend\Http\Controllers\InstituteLeaderboradController::class)->only([
                'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
            ])->names([
                'index'         => 'institute.leaderboard.index',
                'show'          => 'institute.leaderboard.show',
                'create'        => 'institute.leaderboard.create',
                'store'         => 'institute.leaderboard.store',
                'edit'          => 'institute.leaderboard.edit',
                'update'        => 'institute.leaderboard.update',
                'destroy'       => 'institute.leaderboard.destroy'
            ]);

            Route::get('institute/{id}/dashboard', [\Modules\Backend\Http\Controllers\InstituteController::class, 'instituteCheckout'])->name('instituteCheckout');
            Route::post('institute/credential', [\Modules\Backend\Http\Controllers\InstituteController::class, 'institutecredentialSend'])->name('vendor.credential.send');
        });



        Route::middleware('role:' . User::ROLE_ADMIN . ',' . User::ROLE_BlOGGER . ',' . User::ROLE_MANAGER)->group(function () {
            Route::resource('/blog', \Modules\Backend\Http\Controllers\BlogController::class)->only([
                'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
            ])->names([
                'index'         => 'blog.index',
                'show'          => 'blog.show',
                'create'        => 'blog.create',
                'store'         => 'blog.store',
                'edit'          => 'blog.edit',
                'update'        => 'blog.update',
                'destroy'       => 'blog.destroy'
            ]);
            Route::get('/blog/publish/{blog}', [\Modules\Backend\Http\Controllers\BlogController::class, 'publish'])->name('blog.publish');

            Route::get('/blog/{id}/setting', [\Modules\Backend\Http\Controllers\BlogController::class, 'setting'])->name('setting');

            Route::post('/blog/{id}/setting', [\Modules\Backend\Http\Controllers\BlogController::class, 'updateBlogSetting'])->name('blogsetting');


            Route::resource('/blog-category', \Modules\Backend\Http\Controllers\CategoryController::class)->only([
                'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
            ])->names([
                'index'         => 'blog.category.index',
                'show'          => 'blog.category.show',
                'create'        => 'blog.category.create',
                'store'         => 'blog.category.store',
                'edit'          => 'blog.category.edit',
                'update'        => 'blog.category.update',
                'destroy'       => 'blog.category.destroy'
            ]);
            Route::get('/blog-category/publish/{category}', [\Modules\Backend\Http\Controllers\CategoryController::class, 'publish'])->name('category.publish');

            Route::resource('/blog-comment', \Modules\Backend\Http\Controllers\BlogCommentController::class)->only([
                'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
            ])->names([
                'index'         => 'blog.comment.index',
                'show'          => 'blog.comment.show',
                'create'        => 'blog.comment.create',
                'store'         => 'blog.comment.store',
                'edit'          => 'blog.comment.edit',
                'update'        => 'blog.comment.update',
                'destroy'       => 'blog.comment.destroy'
            ]);
            Route::get('blog-approval-queue', [\Modules\Backend\Http\Controllers\BlogCommentController::class, 'approvalqueue'])->name('approvalqueue');

            Route::post('/blog-comment/publish/{comment}', [\Modules\Backend\Http\Controllers\BlogCommentController::class, 'publish'])->name('comment.publish');

            Route::resource('/blog-dashboard', \Modules\Backend\Http\Controllers\BlogDashboardController::class)->only([
                'index', 'show',  'create', 'store',  'edit', 'update', 'destroy'
            ])->names([
                'index'         => 'blog.dashboard.index',
                'show'          => 'blog.dashboard.show',
                'create'        => 'blog.dashboard.create',
                'store'         => 'blog.dashboard.store',
                'edit'          => 'blog.dashboard.edit',
                'update'        => 'blog.dashboard.update',
                'destroy'       => 'blog.dashboard.destroy'
            ]);
        });



        // Route::get('info', function () {
        //     dd(phpinfo());
        // });


    });
});

Route::get('/redirect-url', [\Modules\Backend\Http\Controllers\RedirectController::class, 'index'])->name('redirectIndex');
Route::get('/redirect-create', [\Modules\Backend\Http\Controllers\RedirectController::class, 'create'])->name('redirectCreate');
Route::post('/redirect-store', [\Modules\Backend\Http\Controllers\RedirectController::class, 'store'])->name('redirectStore');
