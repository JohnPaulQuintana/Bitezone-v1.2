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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin','middleware' => 'is_admin','as' => 'admin.'], function () {
        Route::get('dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('index');

    });

    Route::group(['prefix' => 'user','as' => 'user.'], function () {
        Route::get('dashboard', [\App\Http\Controllers\User\UserController::class, 'index'])->name('index');
        Route::post('location', [\App\Http\Controllers\User\UserController::class, 'setLocation'])->name('location');
        Route::get('record', [\App\Http\Controllers\User\UserController::class, 'record'])->name('record');
        Route::get('clinic', [\App\Http\Controllers\User\UserController::class, 'clinic'])->name('clinic');
    });
});


require __DIR__.'/auth.php';
