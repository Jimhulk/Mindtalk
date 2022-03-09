<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
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

Route::get('/', [DashboardController::class, 'index'])->name('homepage');

Route::get('/myProfile/{id}', [DashboardController::class, 'profile'])->name('profilePage');
Route::get('/profile/{id}/{num}', [DashboardController::class, 'profileId'])->name('profileIdPage');

Route::get('/newPost', [DashboardController::class, 'newPost'])->name('newPostPage');
Route::post('/profile/newPost/add', [DashboardController::class, 'addPost'])->name('addPost');
Route::get('/post/{id}/{num}', [DashboardController::class, 'postPage']);

Route::get('/searchPost/{id?}', [DashboardController::class, 'searchPost'])->name('searchPostPage');
Route::post('/searchPost/filter/{num?}', [DashboardController::class, 'filter'])->name('filterPage');
Route::post('/reply/{id}', [DashboardController::class, 'replyAction'])->name('replyAction');

Route::get('/delete/{id}', [DashboardController::class, 'delete'])->name('deleteAction');
Route::get('/deleteCom/{id}/{num}', [DashboardController::class, 'deleteCom'])->name('deleteComAction');

Route::get('/contact', [DashboardController::class, 'contact'])->name('contactPage');

Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/registration', [RegistrationController::class, 'index'])->name('registrationPage');
Route::post('/registration/check', [RegistrationController::class, 'check'])->name('registrationCheck');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/login', [LoginController::class, 'index'])->name('loginPage');
Route::post('/login/check', [LoginController::class, 'check'])->name('loginCheck');
