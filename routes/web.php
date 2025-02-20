<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ToDoListController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\SocialAuthController;

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [ToDoListController::class, 'index'])->middleware('auth')->name('dashboard');
Route::post('/tasks', [ToDoListController::class, 'store'])->middleware('auth')->name('tasks.store');
Route::post('/todolist', [ToDoListController::class, 'store'])->middleware('auth')->name('todolist.store');
Route::patch('/todolist/{todolist}', [ToDoListController::class, 'update'])->middleware('auth')->name('todolist.update');
Route::delete('/todolist/{todolist}', [ToDoListController::class, 'destroy'])->middleware('auth')->name('todolist.destroy');
Route::get('/todolist/{todolist}/edit', [ToDoListController::class, 'edit'])->middleware('auth')->name('todolist.edit');
Route::patch('/todolist/{todolist}/update-nama', [ToDoListController::class, 'updateNama'])->middleware('auth')->name('todolist.updateNama');

Route::get('/todolist/history', [ToDoListController::class, 'history'])->middleware('auth')->name('todolist.history');

Route::get('/settings', [SettingsController::class, 'index'])->middleware('auth')->name('settings');
Route::post('/settings/update', [SettingsController::class, 'update'])->middleware('auth')->name('settings.update');

Route::get('auth/{provider}', [SocialAuthController::class, 'redirectToProvider'])->name('auth.redirect');
Route::get('auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])->name('auth.callback');

Route::get('/', function () {
    return view('landing');
})->name('landing');
