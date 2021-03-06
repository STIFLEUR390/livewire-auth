<?php

use App\Http\Controllers\Back\AdminController;
use App\Http\Livewire\Back\User\ProfileComponent;
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

Route::prefix('admin')->middleware(['auth:sanctum', 'verified', 'permission:base'])->group(function () {

    // Route::get("/", [AdminController::class, 'index'])->name('home');
    Route::middleware(['role:Admin'])->group(function () {
        Route::name('dashboard')->get('/', [AdminController::class, 'index']);
        Route::name('profile')->middleware(['password.confirm'])->get('user/profile', ProfileComponent::class);
    });
});
