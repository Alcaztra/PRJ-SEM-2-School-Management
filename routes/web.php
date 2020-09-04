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

// go to dashboard
Route::get('/', function () {
    return redirect()->intended(route('dashboard'));
});
Route::get('/home', function () {
    return redirect()->intended(route('dashboard'));
})->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// redirect if user already logged in
if (!Auth::guard('admin')->check()) {
    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\AdminLoginController@login');
}

// profile
Route::group(['prefix' => 'profile'], function () {
    //  profile pages
    Route::get('/', 'ProfileController@index')->name('profile');
    //  update profile
    Route::get('update/profile', 'ProfileController@showFormProfile')->name('profile.update.profile');
    Route::post('update/profile', 'ProfileController@updateProfile')->name('profile.update.profile.submit');
    //  update password
    Route::get('update/password', 'ProfileController@showFormPassword')->name('profile.update.password');
    Route::post('update/password', 'ProfileController@updatePassword')->name('profile.update.password.submit');
    //  update avatar
    Route::post('update/avatar', 'ProfileController@updateAvatar')->name('profile.update.avatar');
});

//student
Route::group(['prefix' => 'student'], function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('list', 'StudentController@listStudents')->name('student.list');
        Route::get('create', 'StudentController@showFormCreateStudent')->name('student.create');
        Route::post('create', 'StudentController@createStudent')->name('student.create.submit');
    });
});

// teacher
Route::group(['prefix' => 'teacher'], function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('list', 'TeacherController@listTeachers')->name('teacher.list');
        Route::get('create', 'TeacherController@showFormCreateTeacher')->name('teacher.create');
        Route::post('create', 'TeacherController@createTecher')->name('teacher.create.submit');
    });
});

// course
Route::group(['prefix' => 'course'], function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('list', 'CourseController@listCourses')->name('course.list');
        Route::get('create', 'CourseController@showFormCreateCourse')->name('course.create');
        Route::post('create', 'CourseController@createCourse')->name('course.create.submit');
    });
});

// subject
Route::group(['prefix' => 'subject'], function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('list', 'SubjectController@listSubjects')->name('subject.list');
        Route::get('create', 'SubjectController@showFormCreateSubject')->name('subject.create');
        Route::post('create', 'SubjectController@createSubject')->name('subject.create.submit');
    });
});

// class
Route::group(['prefix' => 'class'], function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('list', 'ClassController@listClasses')->name('class.list');
        Route::get('create', 'ClassController@showFormCreateClass')->name('class.create');
        Route::post('create', 'ClassController@createClass')->name('class.create.submit');
    });
});

// schedule
Route::get('calendar', function () {
    return view('pages.calendar');
});

//demo
Route::get('demo', function () {
    return redirect()->away('https://www.bootstrapdash.com/demo/star-laravel-free/template/');
});

// For Clear cache
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear-cache');

// 404 for undefined routes
Route::any('/{page?}', function () {
    return View::make('pages.error-pages.error-404');
})->where('page', '.*')->name('404-error');
