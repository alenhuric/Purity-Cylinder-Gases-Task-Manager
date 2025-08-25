<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Livewire\Volt\Volt;

Route::get('/', fn() => redirect()->route('tasks.index'))->name('home');

Route::get('/documentation', function () {
    $taskCount = \App\Models\Task::count(); 
    return view('documentation', compact('taskCount'));
})->name('documentation');

Route::prefix('tasks')->name('tasks.')->group(function () {
    Route::post('{task}/toggle', [TaskController::class, 'toggle'])->name('toggle');
    Route::post('{task}/category', [TaskController::class, 'updateCategory'])->name('updateCategory');
    Route::resource('/', TaskController::class)->parameters(['' => 'task']);
});

Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('settings')->group(function () {
    Route::redirect('/', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
