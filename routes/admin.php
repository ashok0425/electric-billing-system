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

Route::middleware('guest:admin')->group(function(){

    Route::get('login','AuthController@login')->name('login');
    Route::post('login','AuthController@loginStore')->name('login');


});

Route::middleware('auth:admin')->group(function(){

    Route::get('dashboard','AuthController@dashboard')->name('dashboard');
    Route::get('profile','AuthController@profile')->name('profile');

    Route::get('dashboard','AuthController@dashboard')->name('dashboard');
    Route::get('primary_setup','AuthController@setup')->name('primary.setup');

    Route::Resource('countries','CountryController');
    Route::get('countries/delete/{id}','CountryController@destroy')->name('countries.delete');


    Route::Resource('states','StateController');
    Route::get('states/delete/{id}','StateController@destroy')->name('states.delete');

    Route::Resource('districts','DistrictController');
    Route::get('districts/delete/{id}','DistrictController@destroy')->name('districts.delete');

    Route::Resource('user_details','UserDetailController');
    Route::get('load-district','UserDetailController@district');
    Route::get('meter-list','UserDetailController@meterlist')->name('meter.index');



    Route::Resource('unit_charges','UnitChargeController');
    Route::get('unit_charges/delete/{id}','UnitChargeController@destroy')->name('unit_charges.delete');


    Route::Resource('consume_units','ConsumeUnitController');
    Route::get('consume_units/delete/{id}','ConsumeUnitController@destroy')->name('consume_units.delete');
    Route::get('load-last-meter','ConsumeUnitController@loadlastmeter');


    Route::get('cms','CmsController@edit')->name('cms.edit');
    Route::post('cms','CmsController@update')->name('cms.update');


    Route::get('franchises','AuthController@index')->name('franchises.index');
    Route::get('franchises/create','AuthController@create')->name('franchises.create');
    Route::post('franchises/store','AuthController@store')->name('franchises.store');
    Route::get('franchises/edit/{id}','AuthController@edit')->name('franchises.edit');
    Route::post('franchises/update/{id}','AuthController@update')->name('franchises.update');
    Route::post('franchises/show/{id}','AuthController@show')->name('franchises.show');


    Route::Resource('accounts','AccountController');
    Route::get('accounts/pay/{id}','AccountController@create')->name('user_details.pay');

    Route::Resource('transfer_meters','TransferMeterController');
    Route::get('transfer_meters/transfer/{id}','TransferMeterController@create')->name('transfer_meters.transfer');
    Route::get('load-unit','TransferMeterController@loadUnit');

    Route::Resource('contacts','ContactController');

    
    Route::Resource('blogs','BlogController');
    Route::get('blogs/delete/{id}','BlogController@destroy')->name('blogs.delete');




});



 

