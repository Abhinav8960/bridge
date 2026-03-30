<?php

use App\Helpers\WhatsappHelepr;
use App\Http\Controllers\StudentAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Jenssegers\Agent\Facades\Agent;

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
// Route::get('/whatsappme', function () {
//    echo WhatsappHelepr::sendErrorNotification();
// })->name('whatsappme');

Auth::routes([
    'register' => false,
    // 'login' => false,
]);

Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('student.login');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login')->name('student.auth.login');
// Register Routes...
Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('student.register');
Route::post('register/store', 'App\Http\Controllers\Auth\RegisterController@create')->name('student.register.store');
// // Password Reset Routes...
Route::get('login-with-otp', 'App\Http\Controllers\Auth\LoginController@showLoginWithotpForm')->name('student.login.with.otp');
Route::post('login-with-otp', 'App\Http\Controllers\Auth\LoginController@loginWithotp')->name('student.auth.with.otp');
Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showForgetPasswordForm')->name('password.request');
Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@sendOtp')->name('password.send.otp');


// Route::get('/', function () {
//     $isDesktop = true;
//     $isMobile = true;
//     if (config('app.env') == 'production') {
//         if (Agent::isMobile()) {
//             $isDesktop = false;
//         }
//         if (Agent::isDesktop()) {
//             $isMobile = false;
//         }
//     }
//     return view('page.home', compact(['isDesktop', 'isMobile']));
// })->name('homepage');
Route::get('/', [App\Http\Controllers\PageController::class, 'home'])->name('homepage');
Route::get('/about', [App\Http\Controllers\PageController::class, 'about'])->name('about');
Route::get('/faq', [App\Http\Controllers\PageController::class, 'faq'])->name('faq');
// Explore
Route::get('/coaching/{slug}', [App\Http\Controllers\PageController::class, 'microsite'])->name('institute.microsite');
// Compare
Route::get('/compare', [App\Http\Controllers\PageController::class, 'compare'])->name('compare.institute');
// Category
Route::as('explore.')->group(function () {
    // Route::get('/{category}/{stream}/{exam}/{country}/{state}/{city}/{area}/{nearme}/{seoslug}', [App\Http\Controllers\ExploreListingController::class, 'explore'])->name('institute');
    Route::get('/{rcategory}/{rstream}/{rexam}/n/{rseoslug}', [App\Http\Controllers\ExploreListingController::class, 'nearme'])->name('institute.nearme');
    Route::get('/{rcategory}/{rstream}/{rexam}/{rstate}/{rcity}/{rarea}/{rseoslug}', [App\Http\Controllers\ExploreListingController::class, 'explore'])->name('institute');
    Route::get('/{rcategory}/{rstream}/{rexam}/{rstate}/{rcity}/{rarea}/{rseoprefix}/{rseoslug}', [App\Http\Controllers\ExploreListingController::class, 'explore'])->name('institute.with.prefix');
    Route::get('/coaching-institutes-in-india', [App\Http\Controllers\ExploreListingController::class, 'india'])->name('india');
    Route::get('/explorepage', [App\Http\Controllers\ExploreListingController::class, 'explorepage'])->name('explorepage');
});
// Enroll
Route::get('/enroll', [App\Http\Controllers\PageController::class, 'enroll'])->name('enroll');
Route::post('/enroll', [App\Http\Controllers\PageController::class, 'storeEnroll'])->name('storeEnroll');
// Contact
Route::get('/contact', [App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::post('/contact', [App\Http\Controllers\PageController::class, 'contactStore'])->name('contactStore');

// Privacy and terms
Route::get('/privacy-policy', [App\Http\Controllers\PageController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/terms-of-use', [App\Http\Controllers\PageController::class, 'termsOfUse'])->name('terms_of_use');



Route::prefix('exams')->as('exams.')->group(function () {
    Route::get('/entrance-exam', [App\Http\Controllers\Exams\EntranceExamController::class, 'index'])->name('entrance-exam');
    Route::get('/government-exam', [App\Http\Controllers\Exams\GovernmentExamController::class, 'index'])->name('government-exam');
    Route::get('/foreign-exam', [App\Http\Controllers\Exams\ForeignExamController::class, 'index'])->name('foreign-exam');
});

Route::middleware('student')->group(function () {
    Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('student.logout');


    Route::get('profile', [App\Http\Controllers\PageController::class, 'profile'])->name('student.profile');
    Route::get('profile/wishlist', [App\Http\Controllers\PageController::class, 'wishlist'])->name('student.wishlist');
    Route::get('profile/enrolled', [App\Http\Controllers\PageController::class, 'enrolled'])->name('student.enrolled');
    Route::get('payment/invoice/{payment_id}', [App\Http\Controllers\PaymentInstamojoRequestController::class, 'invoice'])->name('payment.invoice');
});

Route::get('/blog', [App\Http\Controllers\PageController::class, 'blog'])->name('blog');
Route::get('/blog/archives/{month}/{year}', [App\Http\Controllers\PageController::class, 'blogarchives'])->name('blog.archives');
Route::get('/blog/category/{category}', [App\Http\Controllers\PageController::class, 'blogcategory'])->name('blog.category');
Route::get('/blog/{slug}', [App\Http\Controllers\PageController::class, 'blogdetail'])->name('blog.detail');

Route::prefix('payment')->as('payment.')->group(function () {
    Route::get('/request/{id}', [App\Http\Controllers\PaymentInstamojoRequestController::class, 'initiatePayment'])->name('initiate');
    Route::get('/reinitiate-request/{payment_id}', [App\Http\Controllers\PaymentInstamojoRequestController::class, 'reinitiatePayment'])->name('reinitiate');
    Route::get('/request/status/{payment}', [App\Http\Controllers\PaymentInstamojoRequestController::class, 'paymentload'])->name('paymentload');
    Route::post('/webhook', [App\Http\Controllers\PaymentInstamojoRequestController::class, 'webhook'])->name('webhook');
    Route::get('/response', [App\Http\Controllers\PaymentInstamojoRequestController::class, 'getresponse'])->name('response');
    Route::get('/thank-you/{payment_id}', [App\Http\Controllers\PaymentInstamojoRequestController::class, 'success'])->name('thank-you');
    Route::get('/failure/{payment_id}', [App\Http\Controllers\PaymentInstamojoRequestController::class, 'failure'])->name('failure');
    Route::get('/initiated/{payment_id}', [App\Http\Controllers\PaymentInstamojoRequestController::class, 'initiated'])->name('initiated');
    Route::get('/abort', [App\Http\Controllers\PaymentInstamojoRequestController::class, 'abort'])->name('abort');
});

Route::get('/sitemap.xml', [App\Http\Controllers\SiteMapController::class,'siteMap']);
Route::get('/sitemap-static.xml', [App\Http\Controllers\SiteMapController::class,'sitemapStatic']);

Route::get('/sitemap-locations.xml', [App\Http\Controllers\SiteMapController::class,'sitemapLocations']);
Route::get('/sitemap-category-wise-locations.xml', [App\Http\Controllers\SiteMapController::class,'sitemapLocationWiseCategory']);
Route::get('/sitemap-category-wise-stream-wise-locations.xml', [App\Http\Controllers\SiteMapController::class,'sitemapLocationWiseCategoryWiseStream']);
Route::get('/sitemap-blog.xml', [App\Http\Controllers\SiteMapController::class, 'sitemapBlog']);
