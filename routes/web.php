<?php

use App\Http\Controllers\AnniversaryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BirthdayController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DonerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LateController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\statusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NameController;
use App\Http\Controllers\MegazineController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmploymentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\EducationController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\DashboardController;

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
Route::get('/', [DashboardController::class,'index'])->name('dashboard');
Route::get('history', [DashboardController::class,'history'])->name('history');
Route::get('contact', [DashboardController::class,'contact'])->name('contact');
// Route::get('gallery', [DashboardController::class,'getGallery'])->name('gallery');
// Route::get('blog', [DashboardController::class,'blog'])->name('blog');
Route::get('employees', [DashboardController::class,'employee_records'])->name('employee');
Route::get('OurEmployees', [DashboardController::class, 'index'])->name('OurEmployees.index');
Route::get('employess_data' , [DashboardController::class,'getdata'])->name('employee_data.index');
Route::get('committe', [DashboardController::class,'committe'])->name('commite');
// Route::get('event', [DashboardController::class,'event'])->name('event');
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
    Route::resource('doner',DonerController::class);
    Route::resource('megazine',MegazineController::class);
    Route::resource('employment', EmploymentController::class);
    Route::resource('event', EventController::class);
    Route::resource('sport', SportController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('education', EducationController::class);

    Route::view('/notification', 'notification.create_notification');
    Route::get('/notification', [NotificationsController::class,'index'])->name('notification.index');
    Route::post('/notification_store', [NotificationsController::class,'store'])->name('notification.store');
    Route::get('/notification/create', [NotificationsController::class,'create']);

    Route::get('name/index',[NameController::class,'index'])->name('name.index');
    Route::get('name/create',[NameController::class,'create'])->name('name.create');
    Route::post('name/store',[NameController::class,'store'])->name('name.store');
    Route::get('name/edit/{id}',[NameController::class,'edit'])->name('name.edit');
    Route::put('name/update/{id}',[NameController::class,'update'])->name('name.update');
    Route::get('name/delete/{id}',[NameController::class,'delete'])->name('name.delete');

    Route::view('profile','forms.profile')->name('user.profile');

    Route::get('removeMediaImage',[GalleryController::class,'removeMediaImage'])->name('removeMediaImage');
    
    Route::post('changeStatus/{model}',function($model, Request $request){
        return statusUpdate($model,$request->id);
    })->name('changeStatus');

    Route::get('import_create',[ImportController::class,'index'])->name('import.index');
    Route::post('import', [ImportController::class, 'import'])->name('import');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
