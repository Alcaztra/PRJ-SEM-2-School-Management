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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Auth::routes();

Route::get('/', function () {
    return redirect()->intended(route('dashboard'));
});
Route::get('/home', function () {
    return redirect()->intended(route('dashboard'));
})->name('home');

if (!Auth::guard('admin')->check()) {
    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\AdminLoginController@login');
    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::get('profile/update/password', 'ProfileController@showFormPassword')->name('profile.update.password');
    Route::post('profile/update/password', 'ProfileController@updatePassword')->name('profile.update.password.submit');
    Route::post('profile/update/avatar', 'ProfileController@updateAvatar')->name('profile.update.avatar');
}

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

//demo
Route::get('demo', function () {
    return redirect()->away('https://www.bootstrapdash.com/demo/star-laravel-free/template/');
});

// For Clear cache
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
})->name('clear-cache');

// 404 for undefined routes
Route::any('/{page?}', function () {
    return View::make('pages.error-pages.error-404');
})->where('page', '.*')->name('404-error');
