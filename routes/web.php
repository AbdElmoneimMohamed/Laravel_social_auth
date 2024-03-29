<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GmailController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\SocialAuthController;
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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('auth_redirect/{driver}', [SocialAuthController::class, 'redirect']);
Route::get('auth_callback', [SocialAuthController::class, 'callback']);

