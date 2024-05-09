<?php

use \App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/',[HomeController::class, 'index'])->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/reset', [ProfileController::class, 'reset'])->name('profile.reset');
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin','middleware' => 'is_admin','as' => 'admin.'], function () {
        Route::get('dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('index');
        Route::get('appointment', [\App\Http\Controllers\Admin\AdminController::class, 'appointment'])->name('appointment');
        Route::get('patient', [\App\Http\Controllers\Admin\AdminController::class, 'patient'])->name('patient');
        Route::get('examination/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'examination'])->name('examination');
        Route::post('clinic-setup', [\App\Http\Controllers\Admin\AdminController::class, 'setup'])->name('setup');
        Route::post('treatment', [\App\Http\Controllers\Admin\AdminController::class, 'treatment'])->name('treatment');
        Route::get('edit/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'treatmentEdit'])->name('treatment.edit');
        Route::post('update', [\App\Http\Controllers\Admin\AdminController::class, 'treatmentUpdate'])->name('treatment.update');
        Route::get('vaccination/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'vaccination'])->name('vaccination');
        Route::post('vaccine', [\App\Http\Controllers\Admin\AdminController::class, 'vaccine'])->name('vaccine');
        Route::get('open/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'open'])->name('open');
    });

    Route::group(['prefix' => 'user','as' => 'user.'], function () {
        Route::get('dashboard', [\App\Http\Controllers\User\UserController::class, 'index'])->name('index');
        Route::post('location', [\App\Http\Controllers\User\UserController::class, 'setLocation'])->name('location');
        Route::get('record', [\App\Http\Controllers\User\UserController::class, 'record'])->name('record');
        Route::get('clinic', [\App\Http\Controllers\User\UserController::class, 'clinic'])->name('clinic');
        Route::post('send', [\App\Http\Controllers\User\UserController::class, 'send'])->name('send');
        Route::get('edit/{id}', [\App\Http\Controllers\User\UserController::class, 'edit'])->name('edit');
        Route::post('update', [\App\Http\Controllers\User\UserController::class, 'update'])->name('update');
    });
});


require __DIR__.'/auth.php';
