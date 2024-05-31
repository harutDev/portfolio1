<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;
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
Route::get('/download/{file}', [AdminController::class, 'downloadPDF'])->name('download-pdf');
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
    Route::delete('/delete-pdf', [AdminController::class, 'deletePDF'])->name('deletePDF');

    //post
    Route::post('/login', [ServiceController::class, 'login'])->name('submit_login');
    Route::post('/update-user', [ServiceController::class, 'updateUser'])->name('updateUser');
    Route::post('/update-about_me', [ServiceController::class, 'updateAboutMe'])->name('updateAboutMe');
    Route::post('/create-about_me', [ServiceController::class, 'createAboutMe'])->name('createAboutMe');
    Route::post('/create-post', [ServiceController::class, 'createPost'])->name('createPost')->middleware('auth');
    Route::post('/update-post', [ServiceController::class, 'updatePost'])->name('updatePost');
    Route::post('/create-skills', [ServiceController::class, 'createSkills'])->name('createSkills');
    Route::post('/update-skills', [ServiceController::class, 'updateSkills'])->name('updateSkills');
    Route::post('/create-education', [ServiceController::class, 'createEducation'])->name('createEducation');
    Route::post('/update-education', [ServiceController::class, 'updateEducation'])->name('updateEducation');
    Route::post('/create-links', [ServiceController::class, 'createLinks'])->name('createLinks');
    Route::post('/update-links', [ServiceController::class, 'updateLinks'])->name('updateLinks');
    Route::post('/create-image', [ServiceController::class, 'createImage'])->name('createImage');
    Route::post('/update-image', [ServiceController::class, 'updateImage'])->name('updateImage');
    Route::post('/create-pdf', [ServiceController::class, 'createPDF'])->name('createPDF');
});

// ServiceController -> 40 -> 55
