<?php

use App\Http\Controllers\AnniversaryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BirthdayController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LateController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\statusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotificationsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

// Example Routes
Route::view('/', 'landing');
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables')->name('pages.datatables');
Route::view('/pages/blank', 'pages.blank');

Route::group(['middleware'=>'auth'], function () {

    Route::match(['get', 'post'], '/dashboard', function () {
        return view('dashboard');
    });
    Route::resource('user', UserController::class);
    Route::resource('business', BusinessController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('candidate', CandidateController::class);
    Route::resource('news', NewsController::class);
    Route::resource('recruitment', RecruitmentController::class);
    Route::resource('late', LateController::class);
    Route::resource('gallery',GalleryController::class);
    Route::resource('birthday',BirthdayController::class);
    Route::resource('anniversary',AnniversaryController::class);

    Route::view('/notification', 'notification.create_notification');
    Route::get('/notification', [NotificationsController::class,'index'])->name('notification.index');
    Route::post('/notification_store', [NotificationsController::class,'store'])->name('notification.store');
    Route::get('/notification/create', [NotificationsController::class,'create']);

    Route::view('profile','forms.profile')->name('user.profile');

    Route::get('removeMediaImage',[GalleryController::class,'removeMediaImage'])->name('removeMediaImage');
    Route::post('changeStatus/{model}',function($model, Request $request){
        return statusUpdate($model,$request->id);
    })->name('changeStatus');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

