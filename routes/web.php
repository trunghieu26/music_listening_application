<?php

use App\Http\Controllers\Web\ArtistController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\PlaylistController;
use App\Http\Controllers\Web\RegisterController;
use App\Http\Controllers\Web\UserController;
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

Route::get('/', [HomeController::class, 'index']);

//Route reset password
Route::view('forgot_password', 'auth.reset_password')->name('password.reset');


//Route login
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

//Route register
Route::get('/register',[RegisterController::class, 'index']);
Route::post('/register',[RegisterController::class, 'store']);
Route::get('artist/{id}', [ArtistController::class,'index']);

//Route follow artist
Route::post('/artist/follow', [ArtistController::class, 'followArtist']);
Route::post('/artist/unFollow', [ArtistController::class, 'unFollowArtist']);

//Route
Route::get('/playlist', [PlaylistController::class, 'index']);
//Route forgot password
Route::get('/password/forgot', [AuthController::class,'forgotPassword'])->name('forgot.password.from');


//Route user
Route::get('user/profile',[UserController::class, 'profile']);

//Route like song
Route::post('artist/like-song',[ArtistController::class, 'likeSong']);
Route::post('artist/dislike-song',[ArtistController::class, 'dislikeSong']);