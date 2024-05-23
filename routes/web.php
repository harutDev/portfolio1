<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::resource('users', UserController::class);
Route::get('/', [AdminController::class, 'welcome'])->name('welcome');
Route::get('/admin', [AdminController::class, 'dashboard']);
Route::get('/login', [AdminController::class, 'getLogin'])->name('login');
Route::post('/registration', [AdminController::class, 'registration'])->name('submit_registration');
Route::post('/send', [UserController::class, 'send'])->name('send');
Route::group(['prefix' => 'admins', 'as' => 'admin.'], function () {
    //get
    Route::get('/adminDashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/adminForm', [AdminController::class, 'adminForm'])->name('adminForm');
    Route::get('/adminTable', [AdminController::class, 'adminTable'])->name('adminTable');
    Route::delete('/delete-post', [AdminController::class, 'deletePost'])->name('deletePost');
    Route::get('/delete-skill/{id}', [AdminController::class, 'deleteSkills'])->name('deleteSkills');
    Route::get('/delete-education/{id}', [AdminController::class, 'deleteEducation'])->name('deleteEducation');
    Route::get('/delete-links/{id}', [AdminController::class, 'deleteLinks'])->name('deleteLinks');
    Route::delete('/delete-image', [AdminController::class, 'deleteImage'])->name('deleteImage');

    //post
    Route::post('/login', [AdminController::class, 'login'])->name('submit_login');
    Route::post('/update-user', [AdminController::class, 'updateUser'])->name('updateUser');
    Route::post('/update-about_me', [AdminController::class, 'updateAboutMe'])->name('updateAboutMe');
    Route::post('/create-about_me', [AdminController::class, 'createAboutMe'])->name('createAboutMe');
    Route::post('/create-post', [AdminController::class, 'createPost'])->name('createPost')->middleware('auth');
    Route::post('/update-post', [AdminController::class, 'updatePost'])->name('updatePost');
    Route::post('/create-skills', [AdminController::class, 'createSkills'])->name('createSkills');
    Route::post('/update-skills', [AdminController::class, 'updateSkills'])->name('updateSkills');
    Route::post('/create-education', [AdminController::class, 'createEducation'])->name('createEducation');
    Route::post('/update-education', [AdminController::class, 'updateEducation'])->name('updateEducation');
    Route::post('/create-links', [AdminController::class, 'createLinks'])->name('createLinks');
    Route::post('/update-links', [AdminController::class, 'updateLinks'])->name('updateLinks');
    Route::post('/create-image', [AdminController::class, 'createImage'])->name('createImage');
    Route::post('/update-image', [AdminController::class, 'updateImage'])->name('updateImage');




});
