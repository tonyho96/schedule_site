<?php

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

Route::get('/', function () {
    return redirect('/dashboard/schedules');
});

Auth::routes();

Route::group(['prefix'=>'/dashboard', 'middleware' => ['auth', 'timezone']], function () {
	Route::get('/', 'Dashboard\DashboardController@index')->name('dashboard');

    //Customer routes
    Route::get('/customers/search', 'Dashboard\CustomerProfilesController@showSearchForm')->name('search');
    Route::get('/customers/search-letter', 'Dashboard\CustomerProfilesController@searchcustomer')->name('search-letter');
    Route::get('/customers/create', 'Dashboard\CustomerProfilesController@showAddForm')->name('create');
    Route::post('/customers/create', 'Dashboard\CustomerProfilesController@savecustomer')->name('savecustomer');
     Route::post('/customers/edit-customer', 'Dashboard\CustomerProfilesController@editCustomer')->name('edit-customer');
     Route::post('/customers/edit-pet', 'Dashboard\CustomerProfilesController@editPet')->name('edit-pet');
     
    Route::delete('/customers/deletecustomer/{id}', 'Dashboard\CustomerProfilesController@deletecustomer')->name('deletecustomer');

    Route::get('/customers/detail/{id}', 'Dashboard\CustomerProfilesController@showClientDetailForm')->name('detail');
 	Route::post('/customers/savepet', 'Dashboard\CustomerProfilesController@savePet')->name('savepet');
 	Route::delete('/customers/deletepet/{id}', 'Dashboard\CustomerProfilesController@deletepet')->name('deletepet');

// groomers routes
 	Route::get('/groomers', 'Dashboard\GroomerProfilesController@showSearchForm')->name('groomers');
 	Route::get('/groomers/create', 'Dashboard\GroomerProfilesController@showAddForm')->name('create-groomer');
    Route::post('/groomers/create', 'Dashboard\GroomerProfilesController@savegroomer')->name('save-groomer');
     Route::get('/groomers/detail/{id}', 'Dashboard\GroomerProfilesController@showGroomerDetailForm')->name('detail');
    Route::post('/customers/edit-groomer', 'Dashboard\GroomerProfilesController@editGroomer')->name('edit-groomer');

    //Schedule routes
	Route::get('/schedules', 'Dashboard\AppointmentSchedulingController@index')->name('appointment-scheduling');
	Route::post('/schedules/create-appointment', 'Dashboard\AppointmentSchedulingController@createAppointment')->name('appointments-create');
    Route::post('/schedules/edit-appointment', 'Dashboard\AppointmentSchedulingController@editAppointment')->name('appointments-edit');
    Route::post('/schedules/delete-appointment', 'Dashboard\AppointmentSchedulingController@deleteAppointment')->name('appointments-delete');

	Route::get('/schedules/list', 'Dashboard\AppointmentSchedulingController@getList')->name('appointment-list');
	Route::get('/schedules/search-pet', 'Dashboard\AppointmentSchedulingController@searchPet')->name('search-pet');

	Route::get('/settings', 'Dashboard\ReminderEmailsController@index')->name('reminder-emails');
	Route::post('/settings', 'Dashboard\ReminderEmailsController@save')->name('save-reminder-emails');

	Route::get('/change-password', 'Dashboard\ChangePasswordController@index')->name('change-password');
	Route::post('/change-password', 'Dashboard\ChangePasswordController@ChangeUserPassword')->name('change-password');
	Route::get('/profile', 'Dashboard\ProfileController@index')->name('profile');
	Route::post('/profile', 'Dashboard\ProfileController@ChangeUserProfile')->name('profile');

	Route::get('/account/schedule', 'Dashboard\ScheduleSettingController@index')->name('account-schedule');
	Route::post('/account/schedule', 'Dashboard\ScheduleSettingController@editScheduleSetting')->name('edit-schedule-setting');

	Route::get('/petbreed', 'Dashboard\PetBreedController@index')->name('pet-breed');
    Route::post('/petbreed', 'Dashboard\PetBreedController@store')->name('new-pet-breed');
    Route::get('/petbreed/ajax-search-by-key', 'Dashboard\PetBreedController@ajaxSearchByKey')->name('ajax-search-breed-by-key');
    Route::get('/petbreed/ajax-delete/{id}', 'Dashboard\PetBreedController@ajaxDelete')->name('ajax-delete-breed');
    Route::post('/petbreed/ajax-update/{id}', 'Dashboard\PetBreedController@ajaxUpdate')->name('ajax-update-breed');
});

Route::get('/cron/check-appointment-notification', 'Dashboard\CheckAppointmentNotificationController@index')->name('appointment-notification');
