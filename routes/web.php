<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LateController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationsController;
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

// Example Routes
Route::view('/', 'landing');
Route::match(['get', 'post'], '/dashboard', function () {
    return view('dashboard');
});
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables')->name('pages.datatables');
Route::view('/pages/blank', 'pages.blank');
Route::resource('user', UserController::class);
Route::resource('business', BusinessController::class);
Route::resource('employee', EmployeeController::class);
Route::resource('candidate', CandidateController::class);
Route::resource('news', NewsController::class);
Route::resource('recruitment', RecruitmentController::class);
Route::resource('late', LateController::class);
// Route::resource('notification', NotificationController::class);
Route::view('/notification', 'notification.create_notification');

Route::get('/notification', [NotificationsController::class,'index'])->name('notification.index');
Route::post('/notification_store', [NotificationsController::class,'store'])->name('notification.store');
Route::get('/notification/create', [NotificationsController::class,'create']);
