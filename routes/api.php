<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthenticate;
use App\Http\Controllers\AuthJWTController;
use App\Http\Controllers\UserAuthenticate;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'user'],
    function($router) {

        Route::post('register', [UserAuthenticate::class, 'register'])->name('userRegister');
        Route::post('login', [UserAuthenticate::class, 'login'])->name('userLogin');
        Route::post('logout', [UserAuthenticate::class, 'logout'])->name('userLogout');
        Route::post('about-me', [UserAuthenticate::class, 'aboutMe'])->name('aboutMe');
});

Route::group(['prefix' => 'admin'],
    function ($router) {

        Route::post('register', [AdminAuthenticate::class,'adminRegister'])->name('adminRegister');
        Route::post('login', [AdminAuthenticate::class,'adminLogin'])->name('adminLogin');
        Route::post('logout', [AdminAuthenticate::class,'adminLogout'])->name('adminLogout');
        Route::post('about-me', [AdminAuthenticate::class,'aboutMe'])->name('me');

});

