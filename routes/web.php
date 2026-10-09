<?php

use App\Http\Controllers\Admin\AgentsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\Admin\TwoFactorAuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PropertiesController;
use App\Http\Controllers\Admin\AuctionController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\DealerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BlogTagController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\PropertyReviewController;
use App\Http\Controllers\Admin\AgentReviewController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Agent\AgentHomeController;
use App\Http\Controllers\Agent\AgentDealerController;
use App\Http\Controllers\Agent\AgentPropertiesController;
use App\Http\Controllers\Agent\AgentSettingsController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\PgController;
use App\Http\Controllers\ForgotPasswordController;


//Front Routes
Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/auctions', [FrontController::class, 'auctionProperties'])->name('auction');
Route::get('/auctions/detail/{slug}', [FrontController::class, 'auctionPropertiesDetail'])->name('auction.detail');
Route::get('/search-property', [PropertyController::class, 'search'])->name('search.properties');
Route::get('/property/{category}', [PropertyController::class, 'property'])->name('property');
Route::get('/property', [PropertyController::class, 'property_list'])->name('property_list');
Route::post('/property/filter', [PropertyController::class, 'filter_properties'])->name('property.filter');
Route::get('/property-detail/{slug}', [PropertyController::class, 'propertyDetail'])->name('property.detail');
Route::post('/property/enquiry', [PropertyController::class, 'property_enquiry'])->name('property.enquiry');
Route::post('/properties/enquiry', [PropertyController::class, 'property_enquiry_form'])->name('properties.enquiry.form');
Route::post('enquiry', [PropertyController::class, 'enquiry_property'])->name('front.enquiry');
Route::post('reviewadd', [PropertyController::class, 'review'])->name('front.review');
Route::get('/agent', [FrontController::class, 'agent'])->name('agent');
Route::get('/agent-detail/{id}', [FrontController::class, 'agentDetail'])->name('agent.detail');
Route::get('/blog', [FrontController::class, 'blog'])->name('blog');
Route::get('/blog-detail/{slug}', [FrontController::class, 'blogDetail'])->name('blog.detail');
Route::get('/contact-us', [FrontController::class, 'contact'])->name('contact-us');
Route::post('/contactadd', [FrontController::class, 'contactAdd'])->name('contact_store');
Route::get('/privacy-policy', [FrontController::class, 'privacyPolicy'])->name('front.privacyPolicy');
Route::get('/return-policy', [FrontController::class, 'returnPolicy'])->name('front.returnPolicy');
Route::get('/terms-conditions', [FrontController::class, 'term_condition'])->name('front.term_condition');
Route::get('/faq', [FrontController::class, 'faq'])->name('front.faq');
Route::get('/payment-success', [FrontController::class, 'payment_suceess'])->name('front.payment_suceess');
Route::get('/project', [FrontController::class, 'project'])->name('project');
Route::get('/project-detail/{id}', [FrontController::class, 'projectDetail'])->name('project.detail');
Route::get('/paying-guest', [FrontController::class, 'pg'])->name('pg');
Route::get('/paying-guest-detail/{id}', [FrontController::class, 'pgDetail'])->name('pg.detail');
//frontend 
Route::get('/register', [FrontController::class, 'register'])->name('register');
Route::post('/registerdata', [FrontController::class, 'register_store'])->name('register_store');
Route::post('login', [FrontController::class, 'loginuser'])->name('loginuser');
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
// Route::match(['get', 'post'], '/dealer-register', [FrontController::class, 'dealerregister'])->name('dealerregister');


Route::post('logout', function () {
    Auth::logout();
    Auth::guard('web')->logout();
    return redirect()->route('login');
})->name('logout');


Route::get('/login', function () {
    if (auth()->check()) {
        return redirect()->route('user.dashboard');
    }
    return view('front.login');
})->name('login');


//website dashboards routes users
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [FrontController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/dashboard-myprofile', [FrontController::class, 'dashboardmyprofile'])->name('front.dashboardmyprofile');
    Route::post('/update_profile', [FrontController::class, 'update_profile'])->name('front.update_profile');
    Route::post('/update_social_profile', [FrontController::class, 'update_social_profile'])->name('front.update_social_profile');
    Route::post('/update-password', [FrontController::class, 'updatePassword'])->name('front.updatePassword');
    Route::get('/listing', [FrontController::class, 'dashboardlistingtable'])->name('front.dashboardlistingtable');
    Route::match(['get', 'post'], '/listing/create', [FrontController::class, 'dashboardaddlisting'])->name('front.dashboardaddlisting');
    Route::match(['get', 'post'], '/listing/pg/create', [FrontController::class, 'dashboardcreatepg'])->name('front.dashboardpg');
    Route::get('/listing/pg/list', [FrontController::class, 'dashboardlistpg'])->name('front.dashboardpglist');
    Route::get('/listing/pg/delete/{id}', [FrontController::class, 'listing_pg_delete'])->name('front.listing_pg_delete');
    Route::get('/listing/delete/{id}', [FrontController::class, 'listing_delete'])->name('front.listing_delete');
    Route::get('/listing/status/{id}', [FrontController::class, 'toggleStatus'])->name('front.listing_status');
    Route::match(['get', 'post'], '/listing/edit/{id}', [FrontController::class, 'dashboardeditlisting'])->name('front.dashboardeditlisting');
    Route::get('/dashboard-bookings', [FrontController::class, 'dashboardbookings'])->name('front.dashboardbookings');
    Route::get('/dashboard-review', [FrontController::class, 'dashboardreview'])->name('front.dashboardreview');
    Route::get('/dashboard-agents', [FrontController::class, 'dashboardagents'])->name('front.dashboardagents');
    Route::get('/booking/delete/{id}', [FrontController::class, 'booking_delete'])->name('front.booking_delete');
    Route::post('/listingdeleteimage', [PropertiesController::class, 'deleteImage'])->name('listing.image.delete');
    Route::post('/upload-cover', [FrontController::class, 'upload_cover'])->name('upload-cover');
    Route::post('/upload-profile', [FrontController::class, 'upload_profile'])->name('upload-profile');
});


// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('dynamicSession')->group(function () {
    // Auth::routes();
    Route::get('login', [LoginController::class, 'showAdminLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
    Route::get('/2fa', [TwoFactorAuthController::class, 'index'])->name('2fa')->middleware('auth');
    Route::post('/verify-2fa', [TwoFactorAuthController::class, 'handle2FAOption'])->name('verify.2fa')->middleware('auth');
    Route::post('2fa-verify', [TwoFactorAuthController::class, 'otpverification'])->name('2fa.verification');
    Route::post('/2fa/reset', [TwoFactorAuthController::class, 'resend'])->name('2fa.resend');
    Route::middleware(['auth',  '2fa'])->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::resource('permissions', PermissionController::class);
        Route::resource('roles', RoleController::class);

        //About
        Route::match(['POST', 'GET'], 'admin/about', [AboutController::class, 'update'])->name('about.update');
        Route::get('about/page', [AboutController::class, 'edit_about_page'])->name('about.index');
        //USER
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::match(['get', 'post'], '/users/account/status', [UserController::class, 'status'])->name('users.status');
        //Setting
        Route::get('/setting', [SettingsController::class, 'index'])->name('settings.index');
        Route::match(['get', 'post'], '/setting/activities', [SettingsController::class, 'activities_logs'])->name('settings.logactivities');
        Route::match(['get', 'post'], '/setting/profile', [SettingsController::class, 'profile'])->name('settings.profile');
        Route::match(['get', 'post'], '/setting/password', [SettingsController::class, 'password'])->name('settings.password');
        Route::match(['get', 'post'], '/setting/setting', [SettingsController::class, 'global_setting'])->name('settings.setting');
        Route::match(['get', 'post'], '/setting/websitescript', [SettingsController::class, 'website_script'])->name('settings.websitescript');
        Route::match(['get', 'post'], '/setting/social-media', [SettingsController::class, 'social_media'])->name('settings.social-media');
        //Banner
        Route::get('banner', [BannersController::class, 'index'])->name('banners.index');
        Route::match(['get', 'post'], '/banner/create', [BannersController::class, 'create'])->name('banners.create');
        Route::get('/banner/edit/{id}', [BannersController::class, 'edit'])->name('banners.edit');
        Route::post('/banner/{id}', [BannersController::class, 'update'])->name('banners.update');
        Route::post('/banners/status', [BannersController::class, 'status'])->name('banners.status');
        Route::get('/banner/{id}', [BannersController::class, 'destroy'])->name('banners.delete');
        //blog
        Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
        Route::match(['POST', 'GET'], '/blog/create', [BlogController::class, 'blog_create'])->name('blog.create');
        Route::match(['POST', 'GET'], '/blog/update/{id}', [BlogController::class, 'blog_update'])->name('blog.update');
        Route::get('blog/delete/{id}', [BlogController::class, 'blog_delete'])->name('blog.delete');
        Route::get('blog/status', [BlogController::class, 'blog_status'])->name('blog.status');
        Route::post('/blogdeleteimage', [BlogController::class, 'deleteImage'])->name('blog.image.delete');


        //blog tag
        Route::get('/blog/tag', [BlogTagController::class, 'index'])->name('blog_tag.index');
        Route::match(['POST', 'GET'], '/blog/tag/create', [BlogTagController::class, 'blog_tag_create'])->name('blog_tag.create');
        Route::match(['POST', 'GET'], '/blog/tag/update/{id}', [BlogTagController::class, 'blog_tag_update'])->name('blog_tag.update');
        Route::get('/blog/tag/delete/{id}', [BlogTagController::class, 'blog_tag_delete'])->name('blog_tag.delete');
        Route::get('/blog/tag/status', [BlogTagController::class, 'blog_tag_status'])->name('blog_tag.status');
        //home
        Route::get('privacyPolicy/', [HomeController::class, 'privacy_policy'])->name('privacy_policy');
        Route::match(['POST', 'GET'], 'privacyPolicy/update', [HomeController::class, 'privacy_policy_update'])->name('privacy_policy_update');
        Route::get('termConditions/', [HomeController::class, 'term_condition'])->name('term_condition');
        Route::match(['POST', 'GET'], 'termCondition/update', [HomeController::class, 'term_condition_update'])->name('term_condition_update');
        Route::get('returnPolicy/', [HomeController::class, 'returnPolicy'])->name('returnPolicy');
        Route::match(['POST', 'GET'], 'returnPolicy/update', [HomeController::class, 'returnPolicy_update'])->name('returnPolicy_update');
        // Testmonial
        Route::get('/testimonial', [HomeController::class, 'testimonial_list'])->name('testimonial.index');
        Route::match(['POST', 'GET'], '/testimonial/create', [HomeController::class, 'testimonial_create'])->name('testimonial.create');
        Route::match(['POST', 'GET'], '/testimonial/update/{id}', [HomeController::class, 'testimonial_update'])->name('testimonial.update');
        Route::get('/testimonial/delete/{id}', [HomeController::class, 'testimonial_delete'])->name('testimonial.delete');
        Route::get('/testimonial/status', [HomeController::class, 'testimonial_status'])->name('testimonial.status');
        //faq
        Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
        Route::match(['POST', 'GET'], '/faq/create', [FaqController::class, 'create'])->name('faq.create');
        Route::match(['POST', 'GET'], '/faq/update/{id}', [FaqController::class, 'update'])->name('faq.update');
        Route::get('/faq/delete/{id}', [FaqController::class, 'delete'])->name('faq.delete');
        Route::get('/faq/status', [FaqController::class, 'status'])->name('faq.status');
        //Agent
        Route::get('/agent', [AgentsController::class, 'index'])->name('agent.index');
        Route::get('/agent/create', [AgentsController::class, 'create'])->name('agent.create');
        Route::post('/agent', [AgentsController::class, 'store'])->name('agent.store');
        Route::get('/agent/{user}', [AgentsController::class, 'show'])->name('agent.show');
        Route::get('/agent/{user}/edit', [AgentsController::class, 'edit'])->name('agent.edit');
        Route::put('/agent/{user}', [AgentsController::class, 'update'])->name('agent.update');
        Route::delete('/agent/{user}', [AgentsController::class, 'destroy'])->name('agent.destroy');
        //Dealer
        Route::get('/dealer', [DealerController::class, 'index'])->name('dealer.index');
        Route::get('/dealer/create', [DealerController::class, 'create'])->name('dealer.create');
        Route::post('/dealer', [DealerController::class, 'store'])->name('dealer.store');
        Route::get('/dealer/{user}', [DealerController::class, 'show'])->name('dealer.show');
        Route::get('/dealer/{user}/edit', [DealerController::class, 'edit'])->name('dealer.edit');
        Route::put('/dealer/{user}', [DealerController::class, 'update'])->name('dealer.update');
        Route::delete('/dealer/{user}', [DealerController::class, 'destroy'])->name('dealer.destroy');
        Route::get('/dealer/booking/list', [DealerController::class, 'agent_booking'])->name('dealer.booking');
        Route::get('/dealer/booking/delete/{id}', [DealerController::class, 'booking_delete'])->name('dealer.booking_delete');
        Route::match(['get', 'post'], '/dealer/account/verified', [DealerController::class, 'is_verified'])->name('dealer.is_verified');
        Route::match(['get', 'post'], '/dealer/account/status', [DealerController::class, 'is_status'])->name('dealer.is_status');


        //Category
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/show/{id}', [CategoryController::class, 'show'])->name('product.show');
        Route::match(['get', 'post'], '/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::match(['get', 'post'], '/category/edit/{id}', [CategoryController::class, 'update'])->name('category.edit');
        Route::post('/categorys/status', [CategoryController::class, 'status'])->name('category.status');
        Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        //Location
        Route::get('/location', [LocationController::class, 'index'])->name('location.index');
        Route::get('/location/show/{id}', [LocationController::class, 'show'])->name('location.show');
        Route::match(['get', 'post'], '/location/create', [LocationController::class, 'create'])->name('location.create');
        Route::match(['get', 'post'], '/location/edit/{id}', [LocationController::class, 'update'])->name('location.edit');
        Route::post('/location/status', [LocationController::class, 'status'])->name('location.status');
        Route::get('/location/delete/{id}', [LocationController::class, 'delete'])->name('location.delete');
        //Property
        Route::get('/properties', [PropertiesController::class, 'index'])->name('properties.index');
        Route::match(['get', 'post'], '/properties/create', [PropertiesController::class, 'create'])->name('properties.create');
        Route::match(['get', 'post'], '/properties/edit/{id}', [PropertiesController::class, 'update'])->name('properties.edit');
        Route::get('/properties/{id}', [PropertiesController::class, 'show'])->name('properties.show');
        Route::delete('/properties/{id}', [PropertiesController::class, 'destroy'])->name('properties.destroy');
        Route::match(['get', 'post'], '/properties/account/status', [PropertiesController::class, 'status'])->name('properties.status');
        Route::match(['get', 'post'], '/properties/account/showhome', [PropertiesController::class, 'showHome'])->name('properties.showhome');
        Route::post('/propertiesdeleteimage', [PropertiesController::class, 'deleteImage'])->name('properties.image.delete');
        Route::match(['get', 'post'], '/properties/account/verified', [PropertiesController::class, 'is_verified'])->name('properties.is_verified');
        Route::match(['get', 'post'], '/properties/account/premium', [PropertiesController::class, 'premium'])->name('properties.premium');
        Route::get('/properties-verification', [PropertiesController::class, 'prop_verification'])->name('properties.verification');
        Route::match(['get', 'post'], '/properties-verification/edit/{id}', [PropertiesController::class, 'prop_verification_update'])->name('properties.verification.edit');
        Route::get('/properties/verification/delete/{id}', [PropertiesController::class, 'prop_verification_delete'])->name('properties.verification.delete');



        Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
        Route::match(['get', 'post'], '/project/create', [ProjectController::class, 'create'])->name('project.create');
        Route::match(['get', 'post'], '/project/edit/{id}', [ProjectController::class, 'update'])->name('project.edit');
        Route::get('/project/property/{id}', [ProjectController::class, 'show'])->name('project.show');
        Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');
        Route::match(['get', 'post'], '/project/account/status', [ProjectController::class, 'status'])->name('project.status');
        Route::post('/projectdeleteimage', [ProjectController::class, 'deleteImage'])->name('project.image.delete');
        Route::match(['get', 'post'], '/project/property/create/{id}', [ProjectController::class, 'property_create'])->name('project.property_create');
        Route::match(['get', 'post'], '/project/property/edit/{id}', [ProjectController::class, 'property_update'])->name('project.property_update');
        Route::delete('/project/property/{id}', [ProjectController::class, 'property_destroy'])->name('project.property_destroy');



        Route::get('/pgproperty', [PgController::class, 'index'])->name('pgproperty.index');
        Route::match(['get', 'post'], '/pgproperty/create', [PgController::class, 'create'])->name('pgproperty.create');
        Route::match(['get', 'post'], '/pgproperty/edit/{id}', [PgController::class, 'update'])->name('pgproperty.edit');
        Route::get('/pgproperty/property/{id}', [PgController::class, 'show'])->name('pgproperty.show');
        Route::delete('/pgproperty/{id}', [PgController::class, 'destroy'])->name('pgproperty.destroy');
        Route::match(['get', 'post'], '/pgproperty/account/status', [PgController::class, 'status'])->name('pgproperty.status');
        Route::post('/pgpropertydeleteimage', [PgController::class, 'deleteImage'])->name('pgproperty.image.delete');
        Route::match(['get', 'post'], '/pgproperty/property/create/{id}', [PgController::class, 'pg_property_create'])->name('pgproperty.property_create');
        Route::match(['get', 'post'], '/pgproperty/property/edit/{id}', [PgController::class, 'pg_property_update'])->name('pgproperty.property_update');
        Route::delete('/pgproperty/property/{id}', [PgController::class, 'pg_property_destroy'])->name('pgproperty.property_destroy');



        //Auction
        Route::get('/auctions', [AuctionController::class, 'index'])->name('auctions.index');
        Route::match(['get', 'post'], '/auctions/create', [AuctionController::class, 'create'])->name('auctions.create');
        Route::match(['get', 'post'], '/auctions/edit/{id}', [AuctionController::class, 'update'])->name('auctions.edit');
        //Route::get('/auctions/{id}', [AuctionController::class, 'show'])->name('auctions.show');
        Route::delete('/auctions/{id}', [AuctionController::class, 'destroy'])->name('auctions.destroy');
        Route::match(['get', 'post'], '/auctions-status', [AuctionController::class, 'status'])->name('auctions.status');
        Route::post('/auctionsdeleteimage', [AuctionController::class, 'deleteImage'])->name('auctions.image.delete');
        //Property Review
        Route::get('/review', [PropertyReviewController::class, 'index'])->name('review.index');
        Route::get('/review/delete/{id}', [PropertyReviewController::class, 'delete'])->name('review.delete');
        //Agent Review
        Route::get('/dealer/review/list', [AgentReviewController::class, 'review'])->name('agent_review.index');
        Route::get('/dealer/review/delete/{id}', [AgentReviewController::class, 'delete'])->name('agent_review.delete');
        //Customer
        Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('/customer/block', [CustomerController::class, 'block'])->name('customer.block');
        Route::get('/booking/enquiry', [HomeController::class, 'bookingEnquiry'])->name('booking.enquiry');
    });
});



// Agent Routes
Route::prefix('agentpanel')->name('agent.')->middleware('dynamicSession')->group(function () {
    Route::get('login', [LoginController::class, 'showAgentLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('agent.login');
    Route::get('/2fa', [TwoFactorAuthController::class, 'index'])->name('2fa')->middleware('auth:agent');
    Route::post('/verify-2fa', [TwoFactorAuthController::class, 'handle2FAOption'])->name('verify.2fa')->middleware('auth:agent');
    Route::post('2fa-verify', [TwoFactorAuthController::class, 'otpverification'])->name('2fa.verification');
    Route::post('/2fa/reset', [TwoFactorAuthController::class, 'resend'])->name('2fa.resend');
    Route::middleware(['auth:agent', '2fa'])->group(function () {
        Route::get('/dashboard', [AgentHomeController::class, 'index'])->name('home');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        //Property
        Route::get('/properties', [AgentPropertiesController::class, 'index'])->name('properties.index');
        Route::match(['get', 'post'], '/properties/create', [AgentPropertiesController::class, 'create'])->name('properties.create');
        Route::match(['get', 'post'], '/properties/edit/{id}', [AgentPropertiesController::class, 'update'])->name('properties.edit');
        Route::get('/properties/{id}', [AgentPropertiesController::class, 'show'])->name('properties.show');
        Route::delete('/properties/{id}', [AgentPropertiesController::class, 'destroy'])->name('properties.destroy');
        Route::match(['get', 'post'], '/properties/account/status', [AgentPropertiesController::class, 'status'])->name('properties.status');
        Route::post('/propertiesdeleteimage', [AgentPropertiesController::class, 'deleteImage'])->name('properties.image.delete');

        //Dealer
        Route::get('/dealer', [AgentDealerController::class, 'index'])->name('dealer.index');
        Route::get('/dealer/create', [AgentDealerController::class, 'create'])->name('dealer.create');
        Route::post('/dealer', [AgentDealerController::class, 'store'])->name('dealer.store');
        Route::get('/dealer/{user}', [AgentDealerController::class, 'show'])->name('dealer.show');
        Route::get('/dealer/{user}/edit', [AgentDealerController::class, 'edit'])->name('dealer.edit');
        Route::put('/dealer/{user}', [AgentDealerController::class, 'update'])->name('dealer.update');
        Route::delete('/dealer/{user}', [AgentDealerController::class, 'destroy'])->name('dealer.destroy');

        Route::get('/setting', [AgentSettingsController::class, 'index'])->name('settings.index');
        Route::match(['get', 'post'], '/setting/profile', [AgentSettingsController::class, 'profile'])->name('settings.profile');
        Route::match(['get', 'post'], '/setting/password', [AgentSettingsController::class, 'password'])->name('settings.password');
        Route::match(['get', 'post'], '/setting/setting', [AgentSettingsController::class, 'global_setting'])->name('settings.setting');
    });
});


// Dealer Routes
Route::prefix('dealerpanel')->name('dealer.')->middleware('dynamicSession')->group(function () {
    Route::get('login', [LoginController::class, 'showDealerLoginForm'])->name('login');
    //  Route::post('login', [LoginController::class, 'login'])->name('login');

    Route::middleware(['auth:dealer', '2fa'])->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});



// php artisan db:seed --class=PermissionTableSeeder
// php artisan db:seed --class=CreateAdminUserSeeder