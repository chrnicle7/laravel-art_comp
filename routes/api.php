<?php

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

// Auth
Route::post('login', 'UserApiController@login');
Route::post('register', 'UserApiController@registerStore');

// Get User
Route::get('user/{idUser}', 'UserApiController@getUser');

// Create Challenge
Route::get('challenges', 'ChallengeApiController@getChallenges');
Route::post('challenge/store', 'ChallengeApiController@storeChallenge');

// Create Submission
Route::post('submission/store', 'ChallengeApiController@storeSubmission');

