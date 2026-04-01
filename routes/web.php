<?php

use App\Livewire\Auth\LogIn;
use App\Livewire\Auth\Register;
use App\Livewire\Pages\Admin\Dashboard;
use App\Livewire\Pages\Employee\Dashboard as Employee;
use App\Livewire\Pages\Owner\Dashboard as Owner;
use App\Livewire\Pages\Public\Index;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Index::class)->name('welcome');
Route::get('/login', LogIn::class)->name('login');
Route::get('/register', Register::class)->name('register');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
});

Route::middleware(['auth', 'owner'])->group(function () {
    Route::get('/dashboard', Owner::class)->name('owner.dashboard');
});

Route::middleware(['auth', 'employee'])->group(function () {
    Route::get('/dashboard', Employee::class)->name('employee.dashboard');
});
