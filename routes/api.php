<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AttachmentAPIController;

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

Route::group(['middleware' => 'auth:api'], function () {
    //Route::get('test',[AuthController::class, 'test']);
    //Route::post('uploadImage',[AttachmentAPIController::class, 'store']);
    Route::resource('posts', App\Http\Controllers\API\PostAPIController::class);
    Route::resource('applications', App\Http\Controllers\API\ApplicationAPIController::class);

});

Route::fallback(function () {
    return response()->json(['message' => 'Route not found'], 404);
});

Route::post('login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('sendSubscriptionEmail', [App\Http\Controllers\API\UserAPIController::class, 'sendSubscriptionEmail']);
Route::get('downloadAttchment', [App\Http\Controllers\API\AttachmentAPIController::class, 'downloadApplications']);
Route::get('getAllApplications', [App\Http\Controllers\API\ApplicationAPIController::class, 'index']);
Route::get('getAllPosts', [App\Http\Controllers\API\PostAPIController::class, 'index']);