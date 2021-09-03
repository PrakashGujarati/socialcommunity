<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BusinessController;
use App\Http\Controllers\Api\CandidateController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\LateController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\RecruitmentController;
use App\Http\Controllers\Api\UserController;
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
});
