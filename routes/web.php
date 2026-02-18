<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::livewire('/dashboard', 'dashboard')->name('dashboard');
    Route::livewire('/monthly-calendar', 'monthly-calendar')->name('monthly.calendar');
    Route::livewire('/reports', 'reports')->name('reports');
    Route::livewire('/profile', 'profile')->name('profile');
    Route::livewire('/support', 'support.support')->name('support');
    Route::livewire('/task', 'task.task')->name('task');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/',[DashboardController::class, 'index']);
        Route::resource('user',UserController::class);
        Route::resource('blog', BlogController::class);
        Route::resource('ticket', TicketController::class)->only(['index', 'edit', 'update','destroy']);
        Route::resource('comments',CommentsController::class)->only(['index','destroy','update']);
        Route::get('settings/index', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('settings/update', [SettingsController::class, 'update'])->name('settings.update');
    });
});

Route::get('/login',[AuthController::class,'loginForm'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.post');
Route::get('/register',[AuthController::class,'registerForm'])->name('register');
Route::post('/register',[AuthController::class,'register'])->name('register.post');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');
