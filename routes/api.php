<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BusinessController;
use App\Http\Controllers\Api\CandidateController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\LateController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\RecruitmentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MegazineController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\EmploymentController;
use App\Http\Controllers\Api\SportController;
use App\Http\Controllers\Api\SurnameController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\BirthdayController;
use App\Http\Controllers\Api\AnniversaryController;
use App\Http\Controllers\Api\DonerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);


Route::group(['middleware'=>'auth:api'], function () {
    Route::post('/user_details', [UserController::class,'show']);
    Route::post('user_list', [UserController::class,'list']);
    Route::post('/user_update', [UserController::class,'update']);
    
    Route::post('/business_details', [BusinessController::class,'show']);
    Route::post('/business_list', [BusinessController::class,'list']);
    Route::post('/business_create', [BusinessController::class,'store']);
    Route::post('/business_update', [BusinessController::class,'update']);
    
    Route::post('/employee_details', [EmployeeController::class,'show']);
    Route::post('/employee_list', [EmployeeController::class,'list']);
    Route::post('/employee_create', [EmployeeController::class,'store']);
    Route::post('/employee_update', [EmployeeController::class,'update']);
    
    Route::post('/candidate_details', [CandidateController::class,'show']);
    Route::post('/candidate_list', [CandidateController::class,'list']);
    Route::post('/candidate_create', [CandidateController::class,'store']);
    Route::post('/candidate_update', [CandidateController::class,'update']);
    Route::post('/candidate_show_update', [CandidateController::class,'getListUpdate']);
    Route::post('/candidate_list_update', [CandidateController::class,'getCandidateList']);    

    Route::post('/news_details', [NewsController::class,'show']);
    Route::post('/news_list', [NewsController::class,'list']);
    Route::post('/news_create', [NewsController::class,'store']);
    Route::post('/news_update', [NewsController::class,'update']);

    Route::post('/recruitment_details', [RecruitmentController::class,'show']);
    Route::post('/recruitment_list', [RecruitmentController::class,'list']);
    Route::post('/recruitment_create', [RecruitmentController::class,'store']);
    Route::post('/recruitment_update', [RecruitmentController::class,'update']);

    Route::post('/late_details', [LateController::class,'show']);
    Route::post('/late_list', [LateController::class,'list']);
    Route::post('/late_create', [LateController::class,'store']);
    Route::post('/late_update', [LateController::class,'update']);

    Route::post('/megazine_create', [MegazineController::class,'store']);
    Route::post('/megazine_list' , [MegazineController::class ,'list']);
    Route::post('/megazine_view', [MegazineController::class,'show']);

    Route::post('/gallery_list' , [GalleryController::class , 'list']);
    Route::post('/gallery_view', [GalleryController::class , 'show']);
    Route::post('/gallery_create' , [GalleryController::class , 'store']);
    Route::post('/gallery_update' , [GalleryController::class , 'update']);

    Route::post('/event_list',[EventController::class , 'list']);
    Route::post('/event_view', [EventController::class , 'show']);
    Route::post('/event_create', [EventController::class , 'store']);
    Route::post('/event_update', [EventController::class , 'update']);

    Route::post('/employment_list' , [EmploymentController::class , 'list']);
    Route::post('/employment_view' , [EmploymentController::class , 'show']);
    Route::post('/employment_create' , [EmploymentController::class , 'store']);
    Route::post('/employment_update' , [EmploymentController::class , 'update']);

    Route::post('/sport_list' , [SportController::class , 'list']);
    Route::post('/sport_view' , [SportController::class , 'show']);
    Route::post('/sport_create' , [SportController::class , 'store']);
    Route::post('/sport_update' , [SportController::class , 'update']);

    Route::post('/surname_list' , [SurnameController::class , 'list']);
    Route::post('/surname_create' , [SurnameController::class , 'store']);
    Route::post('/surname_update' , [SurnameController::class , 'update']);

    Route::post('/contact_list' , [ContactController::class , 'list']);
    Route::post('/contact_view' , [ContactController::class , 'show']);
    Route::post('/contact_create' , [ContactController::class , 'store']);
    Route::post('/contact_update' , [ContactController::class , 'update']);

    Route::post('/birthday_list' , [BirthdayController::class , 'list']);
    Route::post('/birthday_create' , [BirthdayController::class , 'store']);
    Route::post('/birthday_view' , [BirthdayController::class , 'show']);
    Route::post('/birthday_update' , [BirthdayController::class , 'update']);

    Route::post('/anniversary_list' , [AnniversaryController::class , 'list']);
    Route::post('/anniversary_create' , [AnniversaryController::class , 'store']);
    Route::post('/anniversary_view' , [AnniversaryController::class , 'show']);
    Route::post('/anniversary_update' , [AnniversaryController::class , 'update']);

    Route::post('/doner_list' , [DonerController::class ,'list']);
    Route::post('/doner_create' , [DonerController::class , 'store']);
    Route::post('/doner_view' , [DonerController::class ,'show']);
    Route::post('/doner_update', [DonerController::class , 'update']);

});
