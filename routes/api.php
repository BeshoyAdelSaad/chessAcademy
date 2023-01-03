<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\UserAuthenticate;
use App\Http\Controllers\AdminAuthenticate;
use App\Http\Controllers\AuthJWTController;

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

Route::group(['prefix' => 'admin'],
    function ($router) {

        Route::post('register', [AdminAuthenticate::class,'adminRegister'])->name('adminRegister');
        Route::post('login', [AdminAuthenticate::class,'adminLogin'])->name('admin-login');
        Route::post('logout', [AdminAuthenticate::class,'adminLogout'])->name('adminLogout');
        Route::post('about-me', [AdminAuthenticate::class,'aboutMe'])->name('me');

});

Route::group(['prefix' => 'user'],
    function($router) {

        Route::post('register', [UserAuthenticate::class, 'register'])->name('userRegister');
        Route::post('login', [UserAuthenticate::class, 'login'])->name('login');
        Route::post('logout', [UserAuthenticate::class, 'logout'])->name('userLogout');
        Route::post('about-me', [UserAuthenticate::class, 'aboutMe'])->name('aboutMe');
});

Route::group(['prefix' => 'users', 'middleware' => 'auth'],
function(){
        Route::post('/play', [RulesController::class,'rules'])->name('play');
        Route::post('/play-with-friend', [RulesController::class,'playWithFriend'])->name('playwithfriend');
        Route::post('/game/room', [RulesController::class,'gameRoom'])->name('gameroom');

});


