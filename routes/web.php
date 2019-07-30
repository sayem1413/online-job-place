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
    return view('home');
});
Auth::routes();

Route::get('new-company', 'Company\RegisterController@showRegistrationForm')->name('new_company_add');
Route::post('company-register', 'Company\RegisterController@register')->name('new_company_register');
Route::get('company-login', 'Company\LoginController@showLoginForm')->name('company_login_form');
Route::post('company-login-save', 'Company\LoginController@login')->name('company_login_save');

Route::get('new-jobseeker', 'JobSeeker\RegisterController@showRegistrationForm')->name('new_jobseeker_add');
Route::post('jobseeker-register', 'JobSeeker\RegisterController@register')->name('new_jobseeker_register');
Route::get('jobseeker-login', 'JobSeeker\LoginController@showLoginForm')->name('jobseeker_login_form');
Route::post('jobseeker-login-save', 'JobSeeker\LoginController@login')->name('jobseeker_login_save');


Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('company')->group(function (){
    Route::group(['middleware'=>['company']],function(){
        Route::get('/home', 'Company\HomeController@index')->name('company_home');
    });
});

Route::prefix('jobseeker')->group(function (){
    Route::group(['middleware'=>['jobseeker']],function(){
        Route::get('/home', 'JobSeeker\HomeController@index')->name('jobseeker_home');
    });
});

