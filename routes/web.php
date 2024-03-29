<?php

use App\Http\Controllers\Api\SpotifyCrawlController;
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
});

Route::get('/spotify/authenticate', [SpotifyCrawlController::class, 'authenticate'])->name('spotify.authenticate');
Route::get('/callback', [SpotifyCrawlController::class, 'handleCallback'])->name('spotify.callback');
Route::get('/music', [SpotifyCrawlController::class, 'showMusic'])->name('music');
Route::get('/albums', [SpotifyCrawlController::class, 'getSeveralAlbums']);
Route::get('/albums/{albumId}', [SpotifyCrawlController::class, 'getAlbum']);
Route::get('/new-release', [SpotifyCrawlController::class, 'getNewReleases']);

Route::get('/album/{albumId}', [SpotifyCrawlController::class, 'getAlbumTracks'])->name('album.show');



Route::get('/home', function () {
    return view('welcome');
})->name('home');
