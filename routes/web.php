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

Route::get('/', 'OtherController@front');
Route::get('/login', 'OtherController@front')->name('login');
Route::get('/clear-cache', 'OtherController@clear_cache');
Route::get('/migrate-run', 'OtherController@migrate_run');

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'front','namespace'=>'Front'],function(){
    Route::get('/', 'FrontController@index')->name('front');
    Route::get('/front-login', 'LoginController@index')->name('front-login');
    Route::post('/front-user-login', 'LoginController@login')->name('front.login');
    Route::get('/create-user', 'LoginController@create')->name('front.create_user');
    Route::post('/store-user', 'LoginController@store')->name('front.store_user');
    Route::get('/forgot', 'LoginController@forgot_password')->name('front.forgot_password');
    Route::post('/send-verification-email','LoginController@send_verification_email')->name('front.send_verification_email');
    Route::get('/reset-password/{token}','LoginController@reset_password')->name('front.reset_password');
    Route::post('/reset/{token}','LoginController@reset')->name('front.reset');
    Route::get('/front-logout','LoginController@logout')->name('front.logout');
    Route::get('/event-listing','FrontController@event_listing')->name('front.event_listing');
    Route::get('/event-detail/{slug}','FrontController@event_detail')->name('front.event_detail');
    Route::get('/artist-listing','FrontController@artist_listing')->name('front.artist_listing');
    Route::get('/artist-detail/{slug}','FrontController@artist_detail')->name('front.artist_detail');
    Route::get('/categories','FrontController@categories')->name('front.categories');
    Route::get('/venue-listing','FrontController@venue_listing')->name('front.venue_listing');
    Route::get('/venue-detail/{slug}','FrontController@venue_detail')->name('front.venue_detail');
    Route::get('/about-us','FrontController@about_us')->name('front.about_us');
    Route::get('/contact-us','FrontController@contact_us')->name('front.contact_us');
    Route::get('/terms-conditions','FrontController@terms_conditions')->name('front.terms_conditions');
    Route::get('/privacy-policy','FrontController@privacy_policy')->name('front.privacy_policy');

    Route::post('/store-contact-us','FrontController@store_contact_us')->name('front.store_contact_us');
    Route::post('/store-enquiry', 'FrontController@store_enquiry')->name('front.store_enquiry');

    Route::get('/verify-account/{token}','LoginController@verify_account')->name('front.verify_account');
    Route::post('/verify-email/{token}','LoginController@verify_email')->name('front.verify_email');
    

    Route::post('/store-news-subscription','FrontController@store_news_subscription')->name('front.store_news_subscription');
    Route::get('/capture-webhook','PaymentController@capture_webhook')->name('front.capture_webhook');
});

Route::group(['prefix'=>'front','namespace'=>'Front','middleware'=> ['auth:front','isActive']],function(){
    Route::get('/profile','UserController@profile')->name('front.profile');
    Route::post('/update-profile','UserController@update_profile')->name('front.update_profile');
    Route::post('/change-password','UserController@change_password')->name('front.change_password');
    Route::post('/update-event-like','UserController@update_event_like')->name('front.update_event_like');
    Route::post('/update-venue-like','UserController@update_venue_like')->name('front.update_venue_like');
    Route::get('/event-ticket-booking/{slug}','FrontController@event_ticket_booking')->name('front.event_ticket_booking');
    Route::get('/event-ticket-booking-cart','FrontController@event_ticket_booking_cart')->name('front.event_ticket_booking_cart');
    Route::post('/update-ticktet-booking','FrontController@update_ticktet_booking')->name('front.update_ticktet_booking');
    Route::get('/get-cart-details','FrontController@get_cart_details')->name('front.get_cart_details');
    Route::get('/collect-payment-details','PaymentController@collect_payment_details')->name('front.collect_payment_details');
    Route::post('/process-payment','PaymentController@process_payment')->name('front.process_payment');
    Route::get('/thank-you','PaymentController@thank_you')->name('front.thank_you');
    Route::get('/my-tickets','FrontController@my_tickets')->name('front.my_tickets');
    Route::get('/favourite-events','FrontController@favourite_events')->name('front.favourite_events');
    Route::get('/download-ticket/{booking_id}','FrontController@download_ticket')->name('front.download_ticket');
    Route::post('/send-invite-email','FrontController@send_invite_email')->name('front.send_invite_email');
    Route::post('/create-checkout-session','PaymentController@create_checkout_session')->name('front.create_checkout_session');
    Route::get('/success-payment','PaymentController@success_payment')->name('front.success_payment');
    Route::get('/cancel-payment','PaymentController@cancel_payment')->name('front.cancel_payment');
    Route::post('/check-ticket-availability','PaymentController@check_ticket_availability')->name('front.check_ticket_availability');
    Route::post('/remove-ticket-from-cart','PaymentController@remove_ticket_from_cart')->name('front.remove_ticket_from_cart');
});

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('/', 'LoginController@index')->name('admin-login');
	Route::post('/admin-login', 'LoginController@login')->name('admin.login');
    Route::get('/forgot', 'LoginController@forgot_password')->name('admin.forgot_password');
    Route::post('/send-verification-email', 'LoginController@send_verification_email')->name('admin.send_verification_email');
    Route::get('/reset-password/{token}', 'LoginController@reset_password')->name('admin.reset_password');
    Route::post('/reset/{token}', 'LoginController@reset')->name('admin.reset');
    Route::get('/admin-logout', 'LoginController@logout')->name('admin.logout');
});

Route::group(['prefix'=>'admin', 'namespace' => 'Admin', 'middleware'=> ['auth:admin']], function () {
    Route::get('/dashboard', 'UserController@dashboard')->name('admin.dashboard');
    Route::get('/list-user', 'UserController@index')->name('admin.list_user');
    Route::get('/create-user', 'UserController@create')->name('admin.create_user');
    Route::post('/store-user', 'UserController@store')->name('admin.store_user');
    Route::get('/show-user/{id}', 'UserController@show')->name('admin.show_user');
    Route::get('/edit-user/{id}', 'UserController@edit')->name('admin.edit_user');
    Route::post('/update-user', 'UserController@update')->name('admin.update_user');
    Route::get('/delete-user/{id}', 'UserController@destroy')->name('admin.delete_user');
    Route::get('/update-user-status/{id}', 'UserController@update_user_status')->name('admin.update_user_status');
    Route::get('/profile-user/{id}', 'UserController@profile')->name('admin.profile_user');

    Route::get('/list-category', 'CategoryController@index')->name('admin.list_category');
    Route::get('/create-category', 'CategoryController@create')->name('admin.create_category');
    Route::post('/store-category', 'CategoryController@store')->name('admin.store_category');
    Route::get('/show-category/{id}', 'CategoryController@show')->name('admin.show_category');
    Route::get('/edit-category/{id}', 'CategoryController@edit')->name('admin.edit_category');
    Route::post('/update-category', 'CategoryController@update')->name('admin.update_category');
    Route::get('/delete-category/{id}', 'CategoryController@destroy')->name('admin.delete_category');
    Route::get('/update-category-status/{id}', 'CategoryController@update_category_status')->name('admin.update_category_status');

    Route::get('/list-ticket-category', 'TicketCategoryController@index')->name('admin.list_ticket_category');
    Route::get('/create-ticket-category', 'TicketCategoryController@create')->name('admin.create_ticket_category');
    Route::post('/store-ticket-category', 'TicketCategoryController@store')->name('admin.store_ticket_category');
    Route::get('/show-ticket-category/{id}', 'TicketCategoryController@show')->name('admin.show_ticket_category');
    Route::get('/edit-ticket-category/{id}', 'TicketCategoryController@edit')->name('admin.edit_ticket_category');
    Route::post('/update-ticket-category', 'TicketCategoryController@update')->name('admin.update_ticket_category');
    Route::get('/delete-ticket-category/{id}', 'TicketCategoryController@destroy')->name('admin.delete_ticket__category');
    Route::get('/update-ticket-category-status/{id}', 'TicketCategoryController@update_ticket_category_status')->name('admin.update_ticket_category_status');

    Route::get('/list-event-ticket/{id}', 'EventTicketController@index')->name('admin.list_event_ticket');
    Route::get('/create-event-ticket/{id}', 'EventTicketController@create')->name('admin.create_event_ticket');
    Route::post('/store-event-ticket', 'EventTicketController@store')->name('admin.store_event_ticket');
    Route::get('/show-event-ticket/{id}', 'EventTicketController@show')->name('admin.show_event_ticket');
    Route::get('/edit-event-ticket/{event_id}/{id}', 'EventTicketController@edit')->name('admin.edit_event_ticket');
    Route::post('/update-event-ticket', 'EventTicketController@update')->name('admin.update_event_ticket');
    Route::get('/delete-event-ticket/{event_id}/{id}', 'EventTicketController@destroy')->name('admin.delete_event_ticket');

    Route::get('/list-content', 'ContentController@index')->name('admin.list_content');
    Route::get('/show-content/{id}', 'ContentController@show')->name('admin.show_content');
    Route::get('/edit-content/{id}', 'ContentController@edit')->name('admin.edit_content');
    Route::post('/update-content', 'ContentController@update')->name('admin.update_content');

    Route::get('/list-venue', 'VenueController@index')->name('admin.list_venue');
    Route::get('/create-venue', 'VenueController@create')->name('admin.create_venue');
    Route::post('/store-venue', 'VenueController@store')->name('admin.store_venue');
    Route::get('/show-venue/{id}', 'VenueController@show')->name('admin.show_venue');
    Route::get('/edit-venue/{id}', 'VenueController@edit')->name('admin.edit_venue');
    Route::post('/update-venue', 'VenueController@update')->name('admin.update_venue');
    Route::get('/delete-venue/{id}', 'VenueController@destroy')->name('admin.delete_venue');
    Route::get('/update-venue-status/{id}', 'VenueController@update_venue_status')->name('admin.update_venue_status');

    Route::get('/list-venue-media/{id}', 'VenueMediaController@index')->name('admin.list_venue_media');
    Route::get('/create-venue-media/{id}', 'VenueMediaController@create')->name('admin.create_venue_media');
    Route::post('/store-venue-media', 'VenueMediaController@store')->name('admin.store_venue_media');
    Route::get('/edit-venue-media/{venue_id}/{id}', 'VenueMediaController@edit')->name('admin.edit_venue_media');
    Route::post('/update-venue-media', 'VenueMediaController@update')->name('admin.update_venue_media');
    Route::get('/delete-venue-media/{venue_id}/{id}', 'VenueMediaController@destroy')->name('admin.delete_venue_media');

    Route::get('/list-venue-video/{id}', 'VenueVideoController@index')->name('admin.list_venue_video');
    Route::get('/create-venue-video/{id}', 'VenueVideoController@create')->name('admin.create_venue_video');
    Route::post('/store-venue-video', 'VenueVideoController@store')->name('admin.store_venue_video');
    Route::get('/edit-venue-video/{venue_id}/{id}', 'VenueVideoController@edit')->name('admin.edit_venue_video');
    Route::post('/update-venue-video', 'VenueVideoController@update')->name('admin.update_venue_video');
    Route::get('/delete-venue-video/{venue_id}/{id}', 'VenueVideoController@destroy')->name('admin.delete_venue_video');

    Route::get('/list-venue-image/{id}', 'VenueImageController@index')->name('admin.list_venue_image');
    Route::get('/create-venue-image/{id}', 'VenueImageController@create')->name('admin.create_venue_image');
    Route::post('/store-venue-image', 'VenueImageController@store')->name('admin.store_venue_image');
    Route::get('/edit-venue-image/{venue_id}/{id}', 'VenueImageController@edit')->name('admin.edit_venue_image');
    Route::post('/update-venue-image', 'VenueImageController@update')->name('admin.update_venue_image');
    Route::get('/delete-venue-image/{venue_id}/{id}', 'VenueImageController@destroy')->name('admin.delete_venue_image');

    Route::get('/list-artist', 'ArtistController@index')->name('admin.list_artist');
    Route::get('/create-artist', 'ArtistController@create')->name('admin.create_artist');
    Route::post('/store-artist', 'ArtistController@store')->name('admin.store_artist');
    Route::get('/show-artist/{id}', 'ArtistController@show')->name('admin.show_artist');
    Route::get('/edit-artist/{id}', 'ArtistController@edit')->name('admin.edit_artist');
    Route::post('/update-artist', 'ArtistController@update')->name('admin.update_artist');
    Route::get('/delete-artist/{id}', 'ArtistController@destroy')->name('admin.delete_artist');
    Route::get('/update-artist-status/{id}', 'ArtistController@update_artist_status')->name('admin.update_artist_status');

    // Route::get('/list-event', 'EventController@index')->name('admin.list_event');
    Route::get('/complete-event', 'EventController@completeindex')->name('admin.complete_event');
    Route::get('/inprocess-event', 'EventController@inprocessindex')->name('admin.inprocess_event');
    Route::get('/upcoming-event', 'EventController@upcomingindex')->name('admin.upcoming_event');
    Route::get('/create-event', 'EventController@create')->name('admin.create_event');
    Route::post('/store-event', 'EventController@store')->name('admin.store_event');
    Route::get('/show-event/{id}', 'EventController@show')->name('admin.show_event');
    Route::get('/edit-event/{id}', 'EventController@edit')->name('admin.edit_event');
    Route::post('/update-event', 'EventController@update')->name('admin.update_event');
    Route::get('/delete-event/{id}', 'EventController@destroy')->name('admin.delete_event');
    Route::get('/update-event-status/{id}', 'EventController@update_event_status')->name('admin.update_event_status');
    Route::get('/update-event-featured-status/{id}', 'EventController@update_event_featured_status')->name('admin.update_event_featured_status');

    Route::get('/list-contact-us', 'UserController@list_contact_us')->name('admin.list_contact_us');
    Route::get('/show-contact-us/{id}', 'UserController@show_contact_us')->name('admin.show_contact_us');

    Route::get('/list-enquiry', 'UserController@list_enquiry')->name('admin.list_enquiry');
    Route::get('/show-enquiry/{id}', 'UserController@show_enquiry')->name('admin.show_enquiry');
    
    Route::get('/subscribe_list', 'UserController@subscribelist')->name('admin.subscribe_list');

    Route::get('/list-payment', 'UserController@list_payment')->name('admin.list_payment');
    Route::post('/export-users', 'UserController@export_users')->name('admin.export_users');
    Route::get('/show-users_export', 'UserController@show_export_user')->name('admin.show_export_user');
    Route::get('/show-export-bookings', 'UserController@show_export_bookings')->name('admin.show_export_bookings');
    Route::post('/export-bookings', 'UserController@export_bookings')->name('admin.export_bookings');
    Route::get('/financial-summary', 'UserController@financial_summary')->name('admin.financial_summary');
    Route::post('/update-artist-popularity', 'ArtistController@update_artist_popularity')->name('admin.update_artist_popularity');
});
?>