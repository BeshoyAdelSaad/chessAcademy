<?php

use App\Http\Controllers\ViewController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');




Route::group(['prefix' => 'user'],
function($router) {

    Route::post('register', [ViewController::class, 'register'])->name('userRegister');
        Route::get('login', [ViewController::class, 'login'])->name('login');
        Route::post('authenticate', [ViewController::class, 'authenticate'])->name('authenticate');
        Route::post('logout', [ViewController::class, 'logout'])->name('userLogout');
        Route::post('about-me', [ViewController::class, 'aboutMe'])->name('aboutMe');
});


    Route::group(['prefix' => 'users', 'middleware' => 'auth'],
    function(){
            Route::post('/play', [ViewController::class,'rules'])->name('play');
            Route::post('/play-with-friend', [ViewController::class,'playWithFriend'])->name('playwithfriend');
            Route::get('/game/room', [ViewController::class,'gameRoom'])->name('gameroom');

    });
