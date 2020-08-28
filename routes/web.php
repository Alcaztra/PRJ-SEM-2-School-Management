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

Route::get('/', function(){
   return redirect()->intended(route('dashboard'));
});

Auth::routes();

// Route::get('login', function() {
//     return view('auth.login');
// })->name('login');
// Route::post('login', 'Auth\\LoginController@login');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

//demo
Route::get('demo', function(){
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