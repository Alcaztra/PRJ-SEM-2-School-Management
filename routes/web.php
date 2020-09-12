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
$domain = parse_url(request()->ip())['path'];
// sub-domain
Route::domain('{user}.localhost',)->where(['user' => 'student'])->get('/', function () {
    print_r(parse_url(request()->getHttpHost()));
});

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
        Route::get('/', function () {
            return redirect(route('student.list'));
        });
        Route::get('list', 'StudentController@listStudents')->name('student.list');
        Route::get('create', 'StudentController@showFormCreateStudent')->name('student.create');
        Route::post('create', 'StudentController@createStudent')->name('student.create.submit');
        // test get ajax
        Route::get('get-students', 'StudentController@getStudents');

        Route::group(['prefix' => '{student_id}'], function () {
            Route::get('/', 'StudentController@showStudentDetails')->name('student.detail');
            Route::get('reset-password', 'StudentController@resetPassword')->name('student.reset.password');
        });
    });
});

// teacher
Route::group(['prefix' => 'teacher'], function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/', function () {
            return redirect(route('teacher.list'));
        });
        Route::get('list', 'TeacherController@listTeachers')->name('teacher.list');
        Route::get('create', 'TeacherController@showFormCreateTeacher')->name('teacher.create');
        Route::post('create', 'TeacherController@createTecher')->name('teacher.create.submit');
        Route::group(['prefix' => '{teacher_id}'], function () {
            Route::get('/', 'TeacherController@showTeacherDetails')->name('teacher.detail');
            Route::get('reset-password', 'TeacherController@resetPassword')->name('teacher.reset.password');
        });

        Route::get('get-teachers', 'TeacherController@getTeachers');
    });
});

// course
Route::group(['prefix' => 'course'], function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/', function () {
            return redirect(route('course.list'));
        });
        Route::get('list', 'CourseController@listCourses')->name('course.list');
        Route::get('create', 'CourseController@showFormCreateCourse')->name('course.create');
        Route::post('create', 'CourseController@createCourse')->name('course.create.submit');

        Route::group(['prefix' => '{course_id}'], function () {
            Route::get('/', 'CourseController@showFormCourseDetails')->name('course.details');
            Route::post('/', 'CourseController@courseDetails')->name('course.details.submit');
        });
    });
});

// subject
Route::group(['prefix' => 'subject'], function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/', function () {
            return redirect(route('subject.list'));
        });
        Route::get('list', 'SubjectController@listSubjects')->name('subject.list');
        Route::get('create', 'SubjectController@showFormCreateSubject')->name('subject.create');
        Route::post('create', 'SubjectController@createSubject')->name('subject.create.submit');

        Route::group(['prefix' => '{subject_id}'], function () {
            Route::get('/', 'SubjectController@showFormSubjectDetails')->name('subject.details');
            Route::post('/', 'SubjectController@subjectDetails')->name('subject.details.submit');
        });
    });
});

// class
Route::group(['prefix' => 'class'], function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/', function () {
            return redirect(route('class.list'));
        });
        Route::get('list', 'ClassController@listClasses')->name('class.list');
        Route::get('create', 'ClassController@showFormCreateClass')->name('class.create');
        Route::post('create', 'ClassController@createClass')->name('class.create.submit');
        // add user
        Route::get('add', 'ClassController@showFormAddUser')->name('class.addUser');
        Route::post('add', 'ClassController@addUser')->name('class.addUser.submit');
        // class details
        Route::group(['prefix' => '{class_id}'], function () {
            Route::get('/', 'ClassController@showFormClassDetails')->name('class.details');
            Route::post('/', 'ClassController@classDetails')->name('class.details.submit');
        });
    });
});

// schedule
Route::group(['prefix' => 'schedule'], function () {
    Route::get('calendar', 'ScheduleController@index');
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
