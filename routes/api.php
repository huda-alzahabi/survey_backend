<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\JWTController;

Route::group(['prefix' => 'v1'], function(){

 Route::group(['prefix' => 'user'], function(){
            Route::get('/get_survey', [UserController::class, 'getSurveyById']);
            Route::post('/submit_answer', [UserController::class, 'submitAnswer']);
      });

    Route::group(['prefix' => 'admin'], function(){
        Route::group(['middleware' => 'role.admin'], function(){
            Route::post('/add_survey', [AdminController::class, 'addSurvey']);
      });
    });

    Route::group(['middleware' => 'api'], function($router) {
        Route::post('/register', [JWTController::class, 'register']);
        Route::post('/login', [JWTController::class, 'login']);
        Route::post('/logout', [JWTController::class, 'logout']);
        Route::post('/refresh', [JWTController::class, 'refresh']);
        Route::post('/profile', [JWTController::class, 'profile']);
    });
 });