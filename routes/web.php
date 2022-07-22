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


Route::get('/',function(){
    return view('frontend.index');
})->name('/');

Route::get('login','AuthController@login')->name('login');
Route::post('login','AuthController@loginStore')->name('login');

Route::middleware('auth')->group(function(){
Route::get('dashboard','AuthController@dashboard')->name('dashboard');

});


Route::get('contact','ContactController@index')->name('contact');
Route::post('contact','ContactController@store')->name('contact');

Route::get('blogs','HomeController@blog')->name('blogs');
Route::get('blog/detail/{id}','HomeController@blogDetail')->name('blog.detail');

Route::get('about-us','HomeController@about')->name('about');
Route::get('privacy-policy','HomeController@privacy')->name('privacy');
Route::get('term','HomeController@term')->name('term');







 

