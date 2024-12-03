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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@redirectAdmin')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/register', 'BerandaController@register')->name('admin-register');
Route::post('/admin/register/store', 'BerandaController@registerStore')->name('admin-register-store');

/**
 * Admin routes
 */
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard');
    Route::resource('roles', 'Backend\RolesController', ['names' => 'admin.roles']);
    Route::resource('users', 'Backend\UsersController', ['names' => 'admin.users']);
    Route::resource('admins', 'Backend\AdminsController', ['names' => 'admin.admins']);

    Route::post('/update-verifikasi/{id}', 'Backend\AdminsController@updateVerifikasi')->name('admins.update-verifikasi');
    Route::post('/reset-password/{id}', 'Backend\AdminsController@resetPassword')->name('admins.reset-password');

    Route::group(['prefix' => 'pengadaan'], function () {
        Route::get('/list', 'Backend\PengadaanController@list')->name('list.pengadaan');
        Route::get('/pengumuman', 'Backend\PengadaanController@pengumuman')->name('pengumuman.pengadaan');
        Route::get('/join-pengadaan/{id}/{vendor}', 'Backend\PengadaanController@join')->name('join.pengadaan');
        Route::get('vendor/{id}', 'Backend\PengadaanController@vendor')->name('pengadaan.vendor');
        Route::post('update-verifikasi-pengadaan/{id}', 'Backend\PengadaanController@updateVerifikasi')->name('pengadaan.update-verifikasi-pengadaan');
        
        Route::get('/', 'Backend\PengadaanController@index')->name('pengadaan');
        Route::get('send-email/{id}/{pengadaan}', 'Backend\PengadaanController@sendEmail')->name('pengadaan.mail');
        Route::get('send-email-test/{id}/{pengadaan}', 'Backend\PengadaanController@sendEmailTest')->name('pengadaan.mail');
        Route::get('create', 'Backend\PengadaanController@create')->name('pengadaan.create');
        Route::post('store', 'Backend\PengadaanController@store')->name('pengadaan.store');
        Route::get('edit/{id}', 'Backend\PengadaanController@edit')->name('pengadaan.edit');
        Route::post('update/{id}', 'Backend\PengadaanController@update')->name('pengadaan.update');
        Route::get('destroy/{id}', 'Backend\PengadaanController@destroy')->name('pengadaan.destroy');
    });

    Route::group(['prefix' => 'fungsi'], function () {
        Route::get('/', 'Backend\FungsiController@index')->name('fungsi');
        Route::get('create', 'Backend\FungsiController@create')->name('fungsi.create');
        Route::post('store', 'Backend\FungsiController@store')->name('fungsi.store');
        Route::get('edit/{id}', 'Backend\FungsiController@edit')->name('fungsi.edit');
        Route::post('update/{id}', 'Backend\FungsiController@update')->name('fungsi.update');
        Route::get('destroy/{id}', 'Backend\FungsiController@destroy')->name('fungsi.destroy');
    });

    Route::group(['prefix' => 'vendor'], function () {
        Route::get('/', 'Backend\AdminsController@vendor')->name('vendor');
    });


    // Login Routes
    Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');

    // Logout Routes
    Route::post('/logout/submit', 'Backend\Auth\LoginController@logout')->name('admin.logout.submit');

    // Forget Password Routes
    Route::get('/password/reset', 'Backend\Auth\ForgetPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset/submit', 'Backend\Auth\ForgetPasswordController@reset')->name('admin.password.update');
});
