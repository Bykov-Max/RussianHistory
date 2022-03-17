<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\UserController;
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

Route::get('/', [CategoryController::class, 'index']);

Route::get('/elements', [ElementController::class, 'index'])->name('elements.index');

Route::get('/elements/filter/{category}', [ElementController::class, 'filter'])->name('elements.filter');

Route::get('/elements/{element}', [ElementController::class, 'oneElement'])->name('elements.oneElement');


Route::get('/register', [RegisterController::class, 'register'])->name('register.index');
Route::post('/register', [RegisterController::class, 'registerStore'])->name('register.store');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginCheck'])->name('login.check');


Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [LoginController::class, 'profile'])->name('profile');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\LoginController::class, 'login'])
        ->name('login');
    Route::post('/', [\App\Http\Controllers\Admin\LoginController::class, 'loginCheck'])
        ->name('login.check');

    Route::get('/users', [UserController::class, 'showUsers'])->name('show.users');
    Route::get('/elements', [ElementController::class, 'showElements'])->name('show.elements');


    Route::middleware('can:admin')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\LoginController::class, 'dashboard'])
            ->name('dashboard');
        Route::get('/logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])
            ->name('logout');

        Route::patch('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
        Route::get('/users-all', [UserController::class, 'allUsers']);
        Route::get('/users/filter/{role}', [UserController::class, 'filterRole']);

        Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');


        Route::get('/elements-all', [ElementController::class, 'allElements']);
        Route::get('/elements/filter/{category}', [ElementController::class, 'filterCategory']);

    });
});