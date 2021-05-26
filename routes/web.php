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

Route::get('/cache_clear',function(){
   Artisan::call('cache:clear');
   echo "Cache Cleared";
});
Route::get('/view_clear',function(){
   Artisan::call('view:clear');
   echo "View Cleared";
});
Route::get('/config_clear',function(){
   Artisan::call('config:cache');
   echo "Config Cleared";
});
Route::get('/route_clear',function(){
   Artisan::call('route:clear');
   echo "Route Cleared";
});

/*
|--------------------------------------------------------------------------
| Front-end
|--------------------------------------------------------------------------
|
| The front-end routes
|
*/
Route::get('/', 'PageController@index');
Route::get('/about', 'PageController@about')->name('about');
Route::get('/services', 'PageController@allServices')->name('services_all');
Route::get('/service/{slug}', 'PageController@services')->name('services');
Route::get('/areas-covered', 'PageController@areas')->name('areas');
Route::get('/contact', 'PageController@contactIndex')->name('contact.index');
Route::post('/contact', 'PageController@contactStore')->name('contact.store');
Route::get('/faqs', 'PageController@faqs')->name('faqs');
Route::get('/prices', 'PageController@prices')->name('prices');
Route::post('/subscribe', 'PageController@subscribe')->name('subscribe');
Route::get('/tcs', 'PageController@termsConditions')->name('terms_conditions');
Route::get('/employment', 'PageController@employment')->name('employment');
Route::get('/booking', 'BookingController@index')->name('booking.index');
Route::post('/booking', 'BookingController@store')->name('booking.store');

Route::post('/forgot/password', 'Auth\ForgotPasswordController@forgotPass')->name('forget.password.user');
Route::get('/reset/{token}', 'Auth\ForgotPasswordController@resetLink')->name('reset.password.link');
Route::post('/reset/password', 'Auth\ForgotPasswordController@passwordReset')->name('reset.password.user');

 /* Booking Inside Routes Start */
Route::group(['prefix' => 'booking'], function () { 
	Route::get('/step1', 'BookingController@loadStep1')->name('booking.step1');
	Route::get('/step2', 'BookingController@loadStep2')->name('booking.step2');
	Route::get('/step3', 'BookingController@loadStep3')->name('booking.step3');
	Route::get('/step4', 'BookingController@loadStep4')->name('booking.step4');
	Route::get('/step2/tenancy', 'BookingController@loadTenancy');
	Route::get('/step2/carpet', 'BookingController@loadCarpet');
	Route::get('/step2/upholstery', 'BookingController@loadUpholstery');
	Route::get('/step2/window', 'BookingController@loadWindow');
	Route::get('/step2/oven', 'BookingController@loadOven');
	Route::get('/step2/one-off', 'BookingController@loadOneOffCleaning');
	Route::get('/step2/regular-fortnightly', 'BookingController@loadRegularFortnightly');
	Route::get('/step2/office', 'BookingController@loadOffice');
	Route::get('/step2/after-builders', 'BookingController@loadAfterBuilders');
	Route::get('/step2/mattress', 'BookingController@loadMattress');
	Route::get('/step2/sofa', 'BookingController@loadSofa');
	Route::get('/step2/unknown', 'BookingController@loadUnknown');
});
/* Booking Inside Routes End */

/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
|
| The admin-panel routes
|
*/
Route::group([
	'prefix' => 'admin_panel',
	'namespace' => 'Admin',
], function () { 

	Route::get('/login', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('admin.login.store');
    Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');

    Route::group([
		'middleware' => 'admin'
	], function () { 

		Route::get('/', 'AdminController@index');
	    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
	    
	    Route::get('/bookings', 'BookingController@bookings')->name('admin.bookings.index');
	    Route::get('/booking/{id}/details', 'BookingController@bookingDetails')->name('admin.bookings.details');
	    Route::get('/getBookingList', 'BookingController@getBookingList');
	    Route::put('/booking/{id}/status', 'BookingController@changeStatus')->name('admin.bookings.status');
	    Route::get('/bookings/calendar', 'BookingController@bookingsCalendar')->name('admin.bookings.calendar');
	    Route::get('/booking/create/{id?}', 'BookingController@bookingCreate')->name('admin.bookings.create');
	    Route::get('/booking/getAddress/{user}', 'BookingController@getAddress');
	    Route::post('/booking', 'BookingController@bookingStore')->name('admin.bookings.store');
	    Route::get('/bookings/log', 'BookingController@bookingsLog')->name('admin.bookings.log');
	    Route::get('/getBookingsLog', 'BookingController@getBookingsLog');

	    Route::get('/invoice/{id}/create', 'InvoiceController@create')->name('admin.invoices.create');
		Route::get('/invoices', 'InvoiceController@index')->name('admin.invoices.index');
	    Route::post('/invoice', 'InvoiceController@store')->name('admin.invoices.store');
	    Route::get('/getInvoicesList', 'InvoiceController@getInvoicesList');
	    Route::get('/invoice/{id}', 'InvoiceController@show')->name('admin.invoices.show');
	    Route::get('/invoice/{id}/edit', 'InvoiceController@edit')->name('admin.invoices.edit');
	    Route::put('/invoice/{id}', 'InvoiceController@update')->name('admin.invoices.update');
	    Route::post('/invoice/send', 'InvoiceController@sendInvoiceToCustomer')->name('admin.invoices.send');
	    Route::get('/invoice_item/{id}/delete', 'InvoiceController@deleteInvoiceItem');
	    Route::get('/invoices/{id}/customer', 'InvoiceController@customerInvoices')->name('admin.invoices.customers');
	    Route::get('/getCustomerInvoicesList/{id}', 'InvoiceController@getCustomerInvoicesList');

	    Route::get('/customers', 'CustomerController@customers')->name('admin.customers.index');
	    Route::get('/getCustomerList', 'CustomerController@getCustomerList');
	    Route::get('/customer/create', 'CustomerController@customerCreate')->name('admin.customers.create');
	    Route::post('/customer', 'CustomerController@customerStore')->name('admin.customers.store');
	    Route::get('/customer/{id}/edit', 'CustomerController@customerEdit')->name('admin.customers.edit');
		Route::put('/customer/{id}', 'CustomerController@customerUpdate')->name('admin.customers.update');    
	    Route::get('/services', 'DashboardController@services')->name('admin.services.index');
	    
	    Route::get('items_prices', 'DashboardController@prices')->name('admin.items_prices.index');
	    Route::put('item_prices/{item}', 'DashboardController@updatePrice')->name('admin.items_prices.update');

	    Route::get('/messages', 'DashboardController@messages')->name('admin.messages.index');
	    Route::get('/getMessagesList', 'DashboardController@getMessagesList');
	    Route::get('/message/{id}/details', 'DashboardController@messageDetails')->name('admin.messages.details');

	    Route::get('/admins', 'AdminController@admins')->name('admin.admins.index');
	    Route::get('/admin/create', 'AdminController@adminCreate')->name('admin.admins.create');
	    Route::post('/admin', 'AdminController@adminStore')->name('admin.admins.store');
	    Route::get('/admin/{id}/edit', 'AdminController@adminEdit')->name('admin.admins.edit');
	    Route::put('/admin/{id}', 'AdminController@adminUpdate')->name('admin.admins.update');

	    Route::get('password', 'AdminController@password')->name('admin.password.index');
    	Route::put('password/{admin}/change', 'AdminController@changePassword')->name('admin.password.update');

    	Route::get('social', 'AdminController@social')->name('admin.social.index');
    	Route::put('social/{id}', 'AdminController@socialUpdate')->name('admin.social.update');

    	Route::get('meta_tags', 'AdminController@metaIndex')->name('admin.meta_tags.index');
    	Route::get('/getMetaTagsPages', 'AdminController@getMetaTagsPages');
    	Route::get('/meta_tag/{meta_tag}/edit', 'AdminController@metaEdit')->name('admin.meta_tags.edit');
    	Route::put('/meta_tag/{meta_tag}', 'AdminController@metaUpdate')->name('admin.meta_tags.update');

    	Route::get('/snippets', 'AdminController@snippetIndex')->name('admin.snippet.index');
    	Route::get('/getSnippets', 'AdminController@getSnippets');
    	Route::get('/snippet/create', 'AdminController@snippetCreate')->name('admin.snippet.create');
	    Route::post('/snippet', 'AdminController@snippetStore')->name('admin.snippet.store');
	    Route::get('/snippet/{snippet}/edit', 'AdminController@snippetEdit')->name('admin.snippet.edit');
	    Route::put('/snippet/{snippet}', 'AdminController@snippetUpdate')->name('admin.snippet.update');
	    Route::get('/snippet/{snippet}/delete', 'AdminController@snippetDestroy')->name('admin.snippet.destroy');
	});
});

/*
|--------------------------------------------------------------------------
| Client Panel
|--------------------------------------------------------------------------
|
| The client-panel routes
|
*/
Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/bookings', 'HomeController@bookings')->name('bookings.index');
Route::get('/booking/{booking}/cancel', 'HomeController@bookingCancel')->name('booking.cancel');
Route::get('/invoices', 'HomeController@invoices')->name('invoices.index');
Route::get('/invoice/{invoice}', 'HomeController@invoiceView')->name('invoice.view');
Route::get('/profile', 'HomeController@profileIndex')->name('profile.index');
Route::post('/profile', 'HomeController@profileStore')->name('profile.store');
Route::get('password', 'HomeController@password')->name('password.index');
Route::put('password/{user}/change', 'HomeController@changePassword')->name('password.update');

