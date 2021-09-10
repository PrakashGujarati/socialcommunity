<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LateController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NameController;
use App\Http\Controllers\MegazineController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmploymentController;
use Illuminate\Support\Facades\Auth;
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

    Route::get('name/index',[NameController::class,'index'])->name('name.index');
    Route::get('name/create',[NameController::class,'create'])->name('name.create');
    Route::post('name/store',[NameController::class,'store'])->name('name.store');
    Route::get('name/edit/{id}',[NameController::class,'edit'])->name('name.edit');
    Route::put('name/update/{id}',[NameController::class,'update'])->name('name.update');
    Route::get('name/delete/{id}',[NameController::class,'delete'])->name('name.delete');

    Route::get('megazine/index',[MegazineController::class,'index'])->name('megazine.index');
    Route::get('megazine/create',[MegazineController::class,'create'])->name('megazine.create');
    Route::post('megazine/store',[MegazineController::class,'store'])->name('megazine.store');
    Route::get('megazine/edit/{id}',[MegazineController::class,'edit'])->name('megazine.edit');
    Route::put('megazine/update/{id}',[MegazineController::class,'update'])->name('megazine.update');
    Route::get('megazine/delete/{id}',[MegazineController::class,'delete'])->name('megazine.delete');

    Route::get('contact/index',[ContactController::class,'index'])->name('contact.index');
    Route::get('contact/create',[ContactController::class,'create'])->name('contact.create');
    Route::post('contact/store',[ContactController::class,'store'])->name('contact.store');
    Route::get('contact/edit/{id}',[ContactController::class,'edit'])->name('contact.edit');
    Route::put('contact/update/{id}',[ContactController::class,'update'])->name('contact.update');
    Route::get('contact/delete/{id}',[ContactController::class,'delete'])->name('contact.delete');

    Route::resource('employment', EmploymentController::class);
    

   

    Route::view('profile','forms.profile')->name('user.profile');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
