<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GmailController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GithubController;
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

// facebook
Route::get('fb_redirect', [FacebookController::class, 'redirectToFacebook']);

Route::get('fb_callback', [FacebookController::class, 'facebookSignin']);

// gmail
Route::get('gmail_redirect', [GmailController::class, 'redirectToGmail']);

Route::get('gmail_callback', [GmailController::class, 'gmailSignin']);


// github
Route::get('github_redirect', [GithubController::class, 'redirectToGithub']);

Route::get('github_callback', [GithubController::class, 'githubSignin']);