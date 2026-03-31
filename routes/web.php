<?php

use App\Livewire\Pages\Admin\Dashboard;
use App\Livewire\Pages\Employee\Dashboard as Employee;
use App\Livewire\Pages\Owner\Dashboard as Owner;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
});

Route::prefix('owner')->group(function () {
    Route::get('/dashboard', Owner::class)->name('owner.dashboard');
});

Route::prefix('employee')->group(function () {
    Route::get('/dashboard', Employee::class)->name('employee.dashboard');
});
