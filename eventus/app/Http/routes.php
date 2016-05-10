<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
 */

Route::group(['middleware' => ['web']], function () {

	Route::get('/admin/halltype_list', 'Admin\HalltypeController@index');
	Route::post('/admin/halltype_list', 'Admin\HalltypeController@index');
	Route::post('/admin/halltype_ajax/{type}', 'Admin\HalltypeController@todo');
	Route::get('/admin/halltype/{id}', 'Admin\HalltypeController@update');
	Route::post('/admin/halltype/{id}', 'Admin\HalltypeController@update');
	Route::get('/admin/halltype', 'Admin\HalltypeController@create');
	Route::post('/admin/halltype', 'Admin\HalltypeController@create');

	Route::get('/admin/location_list', 'Admin\LocationController@index');
	Route::post('/admin/location_list', 'Admin\LocationController@index');
	Route::post('/admin/location_ajax/{type}', 'Admin\LocationController@todo');
	Route::get('/admin/location/{id}', 'Admin\LocationController@update');
	Route::post('/admin/location/{id}', 'Admin\LocationController@update');
	Route::get('/admin/location', 'Admin\LocationController@create');
	Route::post('/admin/location', 'Admin\LocationController@create');

	Route::get('/admin/accommodation_list', 'Admin\AccommodationController@index');
	Route::post('/admin/accommodation_list', 'Admin\AccommodationController@index');
	Route::post('/admin/accommodation_ajax/{type}', 'Admin\AccommodationController@todo');
	Route::get('/admin/accommodation/{id}', 'Admin\AccommodationController@update');
	Route::post('/admin/accommodation/{id}', 'Admin\AccommodationController@update');
	Route::get('/admin/accommodation', 'Admin\AccommodationController@create');
	Route::post('/admin/accommodation', 'Admin\AccommodationController@create');
	
	Route::get('/admin/sitevariable_list', 'Admin\SitevariableController@index');
	Route::post('/admin/sitevariable_list', 'Admin\SitevariableController@index');
	Route::post('/admin/sitevariable_ajax/{type}', 'Admin\SitevariableController@todo');
	Route::get('/admin/sitevariable/{id}', 'Admin\SitevariableController@update');
	Route::post('/admin/sitevariable/{id}', 'Admin\SitevariableController@update');
	Route::get('/admin/sitevariable', 'Admin\SitevariableController@create');
	Route::post('/admin/sitevariable', 'Admin\SitevariableController@create');

	Route::get('/admin/booking_list', 'Admin\BookingController@index');
	Route::post('/admin/booking_list', 'Admin\BookingController@index');
	Route::post('/admin/booking_ajax/{type}', 'Admin\BookingController@todo');
	Route::get('/admin/booking/{id}', 'Admin\BookingController@update');
	Route::post('/admin/booking/{id}', 'Admin\BookingController@update');
	/*Route::get('/admin/booking', 'Admin\BookingController@create');
	Route::post('/admin/booking', 'Admin\BookingController@create');*/

	Route::get('/admin/advertisement_list', 'Admin\AdvertisementController@index');
	Route::post('/admin/advertisement_list', 'Admin\AdvertisementController@index');
	Route::post('/admin/advertisement_ajax/{type}', 'Admin\AdvertisementController@todo');
	Route::get('/admin/advertisement/{id}', 'Admin\AdvertisementController@update');
	Route::post('/admin/advertisement/{id}', 'Admin\AdvertisementController@update');
	Route::get('/admin/advertisement', 'Admin\AdvertisementController@create');
	Route::post('/admin/advertisement', 'Admin\AdvertisementController@create');
	Route::get('/admin/advertisement_statistics/{id}', 'Admin\AdvertisementController@statistics');
	Route::post('/admin/advertisement_statistics/{id}', 'Admin\AdvertisementController@statistics');

	Route::get('/admin/review_list', 'Admin\ReviewController@index');
	Route::post('/admin/review_list', 'Admin\ReviewController@index');
	Route::post('/admin/review_ajax/{type}', 'Admin\ReviewController@todo');
	Route::get('/admin/review/{id}', 'Admin\ReviewController@update');
	Route::post('/admin/review/{id}', 'Admin\ReviewController@update');
	Route::get('/admin/review', 'Admin\ReviewController@create');
	Route::post('/admin/review', 'Admin\ReviewController@create');

	Route::get('/admin/payment_list', 'Admin\PaymentController@index');
	Route::post('/admin/payment_list', 'Admin\PaymentController@index');
	Route::post('/admin/payment_ajax/{type}', 'Admin\PaymentController@todo');
	Route::get('/admin/payment/{id}', 'Admin\PaymentController@update');
	Route::post('/admin/payment/{id}', 'Admin\PaymentController@update');

	Route::get('/admin/addon_list', 'Admin\AddonController@index');
	Route::post('/admin/addon_list', 'Admin\AddonController@index');
	Route::post('/admin/addon_ajax/{type}', 'Admin\AddonController@todo');
	Route::get('/admin/addon/{id}', 'Admin\AddonController@update');
	Route::post('/admin/addon/{id}', 'Admin\AddonController@update');
	Route::get('/admin/addon', 'Admin\AddonController@create');
	Route::post('/admin/addon', 'Admin\AddonController@create');

	Route::get('/admin/subscription_list', 'Admin\SubscriptionController@index');
	Route::post('/admin/subscription_list', 'Admin\SubscriptionController@index');
	Route::post('/admin/subscription_ajax/{type}', 'Admin\SubscriptionController@todo');
	Route::get('/admin/subscription/{id}', 'Admin\SubscriptionController@update');
	Route::post('/admin/subscription/{id}', 'Admin\SubscriptionController@update');
	Route::get('/admin/subscription', 'Admin\SubscriptionController@create');
	Route::post('/admin/subscription', 'Admin\SubscriptionController@create');

	Route::get('/admin/testimonial_list', 'Admin\TestimonialController@index');
	Route::post('/admin/testimonial_list', 'Admin\TestimonialController@index');
	Route::post('/admin/testimonial_ajax/{type}', 'Admin\TestimonialController@todo');
	Route::get('/admin/testimonial/{id}', 'Admin\TestimonialController@update');
	Route::post('/admin/testimonial/{id}', 'Admin\TestimonialController@update');
	Route::get('/admin/testimonial', 'Admin\TestimonialController@create');
	Route::post('/admin/testimonial', 'Admin\TestimonialController@create');

	Route::get('/admin/news_list', 'Admin\NewsController@index');
	Route::post('/admin/news_list', 'Admin\NewsController@index');
	Route::post('/admin/news_ajax/{type}', 'Admin\NewsController@todo');
	Route::get('/admin/news/{id}', 'Admin\NewsController@update');
	Route::post('/admin/news/{id}', 'Admin\NewsController@update');
	Route::get('/admin/news', 'Admin\NewsController@create');
	Route::post('/admin/news', 'Admin\NewsController@create');

	Route::get('/admin/faq_list', 'Admin\FaqController@index');
	Route::post('/admin/faq_list', 'Admin\FaqController@index');
	Route::post('/admin/faq_ajax/{type}', 'Admin\FaqController@todo');
	Route::get('/admin/faq/{id}', 'Admin\FaqController@update');
	Route::post('/admin/faq/{id}', 'Admin\FaqController@update');
	Route::get('/admin/faq', 'Admin\FaqController@create');
	Route::post('/admin/faq', 'Admin\FaqController@create');

	Route::get('/admin/facilities_list', 'Admin\FacilitiesController@index');
	Route::post('/admin/facilities_list', 'Admin\FacilitiesController@index');
	Route::post('/admin/facilities_ajax/{type}', 'Admin\FacilitiesController@todo');
	Route::get('/admin/facilities/{id}', 'Admin\FacilitiesController@update');
	Route::post('/admin/facilities/{id}', 'Admin\FacilitiesController@update');
	Route::get('/admin/facilities', 'Admin\FacilitiesController@create');
	Route::post('/admin/facilities', 'Admin\FacilitiesController@create');

	Route::get('/admin/content_list', 'Admin\ContentController@index');
	Route::post('/admin/content_list', 'Admin\ContentController@index');
	Route::post('/admin/content_ajax/{type}', 'Admin\ContentController@todo');
	Route::get('/admin/content/{id}', 'Admin\ContentController@update');
	Route::post('/admin/content/{id}', 'Admin\ContentController@update');
	Route::get('/admin/content', 'Admin\ContentController@create');
	Route::post('/admin/content', 'Admin\ContentController@create');

	Route::get('/admin/email_list', 'Admin\EmailController@index');
	Route::post('/admin/email_list', 'Admin\EmailController@index');
	Route::post('/admin/email_ajax/{type}', 'Admin\EmailController@todo');
	Route::get('/admin/email/{id}', 'Admin\EmailController@update');
	Route::post('/admin/email/{id}', 'Admin\EmailController@update');
	Route::get('/admin/email', 'Admin\EmailController@create');
	Route::post('/admin/email', 'Admin\EmailController@create');

	Route::get('/admin/user_list', 'Admin\UserController@index');
	Route::post('/admin/user_ajax/{type}', 'Admin\UserController@todo');
	Route::get('/admin/user/{id}', 'Admin\UserController@update');
	Route::post('/admin/user/{id}', 'Admin\UserController@update');
	Route::get('/admin/user', 'Admin\UserController@create');
	Route::post('/admin/user', 'Admin\UserController@create');

	Route::get('/admin/price_range_list', 'Admin\PricerangeController@index');
	Route::post('/admin/price_range_list', 'Admin\PricerangeController@index');
	Route::post('/admin/price_range_ajax/{type}', 'Admin\PricerangeController@todo');
	Route::get('/admin/price_range/{id}', 'Admin\PricerangeController@update');
	Route::post('/admin/price_range/{id}', 'Admin\PricerangeController@update');
	Route::get('/admin/price_range', 'Admin\PricerangeController@create');
	Route::post('/admin/price_range', 'Admin\PricerangeController@create');

	Route::get('/admin/hall_list', 'Admin\HallController@index');
	Route::post('/admin/hall_ajax/{type}', 'Admin\HallController@todo');
	Route::get('/admin/hall/{id}', 'Admin\HallController@update');
	Route::post('/admin/hall/{id}', 'Admin\HallController@update');
	Route::get('/admin/hall', 'Admin\HallController@create');
	Route::post('/admin/hall', 'Admin\HallController@create');
	Route::get('/admin/hall/displayimages', 'Admin\HallController@displayimages');
	Route::post('/admin/hall_getuserdetails', 'Admin\HallController@getuserdetails');
	Route::post('/admin/hall_deleteimages', 'Admin\HallController@deleteImage');
	Route::post('/admin/hall_imageorder', 'Admin\HallController@sortImageOrder');
	Route::post('/admin/hall_caption-image', 'Admin\HallController@captionImage');
	Route::post('/admin/hall_insrtaddon', 'Admin\HallController@insrtaddon');
	Route::post('/admin/hall/insrtlocation', 'Admin\HallController@insrtlocation');
	Route::post('/admin/hall_insrtaccommodation', 'Admin\HallController@insrtaccommodation');
	Route::post('/admin/hall_addonchecker', 'Admin\HallController@addonchecker');
	Route::post('/admin/hall_accommodationchecker', 'Admin\HallController@accommodationchecker');
	Route::get('/admin/hall_selectaddon', 'Admin\HallController@selectaddon');

	Route::post('/admin/hall_subscription_payment/{id}', 'Admin\HallController@hallSubscriptionPayment');
	Route::get('/admin/hall_calender/{id}', 'Admin\HallController@selectcalender');
	Route::get('/admin/hall_block-dates/{id}', 'Admin\HallController@setCalenderBlockDates');
	Route::post('/admin/hall_block-dates/{id}', 'Admin\HallController@setCalenderBlockDates');
	Route::resource('/admin/hall_calender_get_dates', 'Admin\HallController@get_particular_dates');
	Route::resource('/admin/hall_calender_get_weekdays', 'Admin\HallController@get_weekdays');
	Route::resource('/admin/hall_calender_get_monthdays', 'Admin\HallController@get_monthdays');
	Route::resource('/admin/hall_block-dates-delete', 'Admin\HallController@deleteCalenderBlockDates');

	Route::get('/admin/hall_selectaccommodation', 'Admin\HallController@selectaccommodation');
	Route::get('/admin/hall_uploadimage/{id}', 'Admin\HallController@uploadimage');
	//Route::get('/admin/hall_setlocation/{id}', 'Admin\HallController@showlocation');
	Route::post('/admin/hall_setlocation/{id}', 'Admin\HallController@setlocation');
	Route::post('/admin/hall_multipleimage/{id}', 'Admin\HallController@multipleimage');
	Route::get('/admin/hall_addon/{id}', 'Admin\HallController@addon');
	Route::post('/admin/hall_appendingimages/{id}', 'Admin\HallController@appendingImages');
	Route::get('/admin/hall_accommodation/{id}', 'Admin\HallController@accommodation');
	Route::get('/admin/hall_subscription/{id}', 'Admin\HallController@subscription');
	Route::get('/admin/hall', 'Admin\HallController@create');
	Route::get('/admin/hall/selectlocation', 'Admin\HallController@selectlocation');
	Route::get('/admin/hall/selechalltype', 'Admin\HallController@selechalltype');
	Route::get('/admin/hall/selectprovince', 'Admin\HallController@selectprovince');
	Route::get('.', 'Admin\HallController@autouser');
	Route::get('/admin/hall/selectuser', 'Admin\HallController@selectuser');
	Route::post('/admin/hall/fetch_user_data', 'Admin\HallController@fetch_user_data');
	Route::post('/admin/hall/store', 'Admin\HallController@store');

	Route::get('/admin/homepagebanner_list', 'Admin\HomepagebannerController@index');
	Route::post('/admin/homepagebanner_list', 'Admin\HomepagebannerController@index');
	Route::post('/admin/homepagebanner_ajax/{type}', 'Admin\HomepagebannerController@todo');
	Route::get('/admin/homepagebanner/{id}', 'Admin\HomepagebannerController@update');
	Route::post('/admin/homepagebanner/{id}', 'Admin\HomepagebannerController@update');
	Route::get('/admin/homepagebanner', 'Admin\HomepagebannerController@create');
	Route::post('/admin/homepagebanner', 'Admin\HomepagebannerController@create');

	Route::get('/admin/innerpagebanner_list', 'Admin\InnerpagebannerController@index');
	Route::post('/admin/innerpagebanner_list', 'Admin\InnerpagebannerController@index');
	Route::post('/admin/innerpagebanner_ajax/{type}', 'Admin\InnerpagebannerController@todo');
	Route::get('/admin/innerpagebanner/{id}', 'Admin\InnerpagebannerController@update');
	Route::post('/admin/innerpagebanner/{id}', 'Admin\InnerpagebannerController@update');
	Route::get('/admin/innerpagebanner', 'Admin\InnerpagebannerController@create');
	Route::post('/admin/innerpagebanner', 'Admin\InnerpagebannerController@create');

	Route::get('/admin/settings', 'Admin\SettingsController@create');
	Route::post('/admin/settings', 'Admin\SettingsController@create');

/*	Route::get('/admin/advertisement_list', 'Admin\AdvertisementController@index');
Route::get('/admin/advertisement', 'Admin\AdvertisementController@create');
Route::get('/admin/advertisement/getposition', 'Admin\AdvertisementController@getPosition');
Route::post('/admin/advertisement/store', 'Admin\AdvertisementController@store');
Route::get('/admin/advertisement/{id}', 'Admin\AdvertisementController@show');
Route::put('/admin/advertisement/update/{id}', 'Admin\AdvertisementController@update');
Route::delete('/admin/advertisement/{id}', 'Admin\AdvertisementController@delete');

/*	Route::get('/admin/hall_list', 'Admin\HallController@index');
Route::get('/admin/hall', 'Admin\HallController@create');
Route::get('/admin/hall/getposition', 'Admin\HallController@getPosition');
Route::post('/admin/hall/store', 'Admin\HallController@store');
Route::get('/admin/hall/{id}', 'Admin\HallController@show');
Route::put('/admin/hall/update/{id}', 'Admin\HallController@update');
Route::delete('/admin/hall/{id}', 'Admin\HallController@delete');

Route::get('/admin/hall_list', 'Admin\HallController@index');
Route::get('/admin/hall/displayimages', 'Admin\HallController@displayimages');
Route::post('/admin/hall/deleteimage', 'Admin\HallController@deleteimage');
Route::post('/admin/hall/insrtaddon', 'Admin\HallController@insrtaddon');
Route::post('/admin/hall/insrtlocation', 'Admin\HallController@insrtlocation');
Route::post('/admin/hall/insrtaccommodation', 'Admin\HallController@insrtaccommodation');
Route::post('/admin/hall/addonchecker', 'Admin\HallController@addonchecker');
Route::post('/admin/hall/accommodationchecker', 'Admin\HallController@accommodationchecker');
Route::get('/admin/hall/selectaddon', 'Admin\HallController@selectaddon');
Route::get('/admin/hall/selectaccommodation', 'Admin\HallController@selectaccommodation');
Route::get('/admin/hall/uploadimage/{id}', 'Admin\HallController@uploadimage');
Route::get('/admin/hall/set-location/{id}', 'Admin\HallController@setlocation');
Route::post('/admin/hall/multipleimage/', 'Admin\HallController@multipleimage');
Route::get('/admin/hall/addon/{id}', 'Admin\HallController@addon');
Route::get('/admin/hall/accommodation/{id}', 'Admin\HallController@accommodation');
Route::get('/admin/hall/subscription/{id}', 'Admin\HallController@subscription');
Route::get('/admin/hall', 'Admin\HallController@create');
Route::get('/admin/hall/selectlocation', 'Admin\HallController@selectlocation');
Route::get('/admin/hall/selechalltype', 'Admin\HallController@selechalltype');
Route::get('/admin/hall/selectprovince', 'Admin\HallController@selectprovince');
Route::get('/admin/hall/autouser', 'Admin\HallController@autouser');
Route::get('/admin/hall/selectuser', 'Admin\HallController@selectuser');
Route::post('/admin/hall/fetch_user_data', 'Admin\HallController@fetch_user_data');
Route::post('/admin/hall/store', 'Admin\HallController@store');
Route::get('/admin/hall/{id}', 'Admin\HallController@show');
Route::put('/admin/hall/update/{id}', 'Admin\HallController@update');
Route::delete('/admin/hall/{id}', 'Admin\HallController@delete');**/

});

Route::group(['middleware' => ['web']], function () {
	//Login Routes...
	Route::get('/admin/login', 'AdminAuth\AuthController@showLoginForm');
	Route::post('/admin/login', 'AdminAuth\AuthController@login');
	Route::get('/admin/logout', 'AdminAuth\AuthController@getLogout');

	// Registration Routes...
	//Route::get('admin/register', 'AdminAuth\AuthController@showRegistrationForm');
	//Route::post('admin/register', 'AdminAuth\AuthController@register');

	Route::auth();
	Route::get('/admin', 'AdminController@index');

});

Route::group(['middleware' => ['web']], function () {
/*Route::get('/', function () {
return view('welcome');
});*/
	Route::get('/', 'HomeController@index');
	Route::resource('/search', 'HomeController@search');

	Route::get('/hall/{id}', 'HallController@index');
	
	Route::get('/cron', 'CronController@index');

	Route::resource('/book-hall', 'HallController@showbook');
	Route::resource('/book-my-hall', 'HallController@updatebook');
	Route::resource('/payment', 'HallController@payment');
	Route::resource('/thanks-hall', 'HallController@paymentThanks');

	Route::get('/gethalltype', 'AjaxController@getHalltype');
	Route::get('/getpricerange', 'AjaxController@getPricerange');
	Route::get('/getLocation', 'AjaxController@getLocation');
	Route::get('/getProvince', 'AjaxController@getProvince');
	Route::get('/getLocationAuto', 'AjaxController@getLocationAuto');
	Route::get('/getProvinceAuto', 'AjaxController@getProvinceAuto');
	Route::post('/setlanguage', 'AjaxController@setLanguage');
	Route::post('/setcurrency', 'AjaxController@setCurrency');
	Route::post('/setfavorite', 'AjaxController@setFavorite');
	Route::post('/setreview', 'AjaxController@setReview');
	Route::post('/setenquiry', 'AjaxController@setEnquiry');
	Route::post('/setnewsletter', 'AjaxController@setNewsletter');
	Route::post('/currentlocation', 'AjaxController@currentLocation');
	Route::post('/getavailability', 'AjaxController@getAvailability');
	Route::post('/setadvclick', 'AjaxController@advClick');

	/*===================All Register Authentication Router Start=========================*/
	Route::get('/register-thanks', 'RegisterController@index');
	Route::get('/complete-registration/{id}', 'RegisterController@show');
	/*===================All Register Authentication Router End=========================*/

	/*=======================All Front-End Dashboard Router Start============================*/
	Route::get('/dashboard', 'DashboardController@index');
	Route::get('/dashboard/edit-profile', 'DashboardController@editProfile');
	Route::post('/dashboard/profile-picture', 'DashboardController@profilePicture');
	Route::get('/dashboard/change-password', 'DashboardController@changePassword');
	Route::post('/dashboard/update-profile', 'DashboardController@updateProfile');
	Route::post('/dashboard/update-password', 'DashboardController@updatePassword');
	Route::resource('/edit-redirects', 'DashboardController@details');
	Route::resource('/edit-photos', 'DashboardController@photos');
	Route::resource('/edit-addons', 'DashboardController@addons');
	Route::resource('/edit-accommodations', 'DashboardController@accommodations');
	Route::resource('/edit-subscription', 'DashboardController@subscription');
	Route::resource('/edit-calendar', 'DashboardController@calender');
	Route::resource('/delete-hall', 'DashboardController@deleteHall');
	Route::resource('/dashboard/my-hall', 'DashboardController@myHall');
	Route::resource('/dashboard/add-my-hall', 'DashboardController@addMyHall');
	Route::resource('/dashboard/addhall-validate', 'DashboardController@addMyHallValidate');
	Route::resource('/dashboard/hall/uploadimage', 'DashboardController@uploadImages');
	Route::resource('/dashboard/hall/imageorder', 'DashboardController@sortImageOrder');
	Route::resource('/dashboard/hall/calender/', 'DashboardController@setCalender');
	Route::resource('/dashboard/hall/calender/block-dates', 'DashboardController@setCalenderBlockDates');
	Route::resource('/dashboard/hall/calender/block-dates-delete', 'DashboardController@deleteCalenderBlockDates');
	Route::post('/dashboard/hall/multipleimage/', 'DashboardController@multipleimage');
	Route::resource('/dashboard/hall/caption-image', 'DashboardController@captionImage');
	Route::resource('/dashboard/hall/delete', 'DashboardController@deleteImage');
	Route::resource('/dashboard/hall/addon', 'DashboardController@hallAddon');
	Route::post('/dashboard/hall/addonchecker', 'DashboardController@addonchecker');
	Route::resource('/dashboard/hall/insrtaddon', 'DashboardController@insrtaddon');
	Route::resource('/dashboard/hall/accommodation', 'DashboardController@hallAccommodation');
	Route::resource('/dashboard/hall/accommodationchecker', 'DashboardController@accommodationchecker');
	Route::resource('/dashboard/hall/insrtaccommodation', 'DashboardController@insrtaccommodation');
	Route::resource('/dashboard/hall/subscription', 'DashboardController@hallSubscription');
	Route::resource('/dashboard/hall/subscription/payment', 'DashboardController@hallSubscriptionPayment');
	Route::resource('/dashboard/hall/subscription/thank-you', 'DashboardController@hallSubscriptionThankYou');
	Route::resource('/dashboard/hall/subscription/cancel-payment', 'DashboardController@hallSubscriptionCancelPayment');
	Route::resource('/dashboard/my-favourite', 'DashboardController@myFavourite');
	Route::resource('/dashboard/fav/delete', 'DashboardController@myFavouriteDelete');
	Route::resource('/dashboard/review-&-ratings', 'DashboardController@reviewRatings');
	Route::resource('/dashboard/reviews-on-my-hall', 'DashboardController@reviewsOnMyHall');
	Route::resource('/dashboard/enquiries', 'DashboardController@enquiries');
	Route::resource('/dashboard/single/enquiry', 'DashboardController@enquiryView');
	Route::resource('/msr', 'DashboardController@setMessageid');
	Route::resource('/dashboard/single/sent-reply', 'DashboardController@messageReply');
	Route::resource('/dashboard/hall/calender/get_particular_dates', 'DashboardController@get_particular_dates');
	Route::resource('/dashboard/hall/calender/get_weekdays', 'DashboardController@get_weekdays');
	Route::resource('/dashboard/hall/calender/get_monthdays', 'DashboardController@get_monthdays');
	Route::post('/dashboard/hall/appending-images', 'DashboardController@appendingImages');
	Route::resource('/dashboard/my-booking', 'DashboardController@myBooking');
	Route::resource('/dashboard/booking-on-my-hall', 'DashboardController@bookingOnMyHall');
	/*=======================All Front-End Dashboard Router End============================*/

	/*=======================All CMS Pages Router Start============================*/
	Route::resource('/terms-and-condition', 'CmsController@termCondition');
	Route::resource('/about-us', 'CmsController@aboutUs');
	Route::resource('/privacy-policy', 'CmsController@privacyPolicy');
	Route::resource('/news', 'CmsController@showNews');
	Route::resource('/faq', 'CmsController@showFaq');
	Route::resource('/contact-us', 'CmsController@contactUs');
	Route::resource('/cms/validate', 'CmsController@contactUsValidate');
	/*=======================All CMS Pages Router End============================*/

});