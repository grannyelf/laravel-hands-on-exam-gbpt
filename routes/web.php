<?php

use App\Livewire\Auth\LogIn;
use App\Livewire\Auth\Register;
use App\Livewire\Pages\Admin\Dashboard as Admin;
use App\Livewire\Pages\Admin\History\HistoryUser;
use App\Livewire\Pages\Admin\Role\CreateRole;
use App\Livewire\Pages\Admin\Role\EditRole;
use App\Livewire\Pages\Admin\Role\IndexRole;
use App\Livewire\Pages\Admin\User\CreateUser;
use App\Livewire\Pages\Admin\User\EditUser;
use App\Livewire\Pages\Admin\User\IndexUser;
use App\Livewire\Pages\Employee\Dashboard as Employee;
use App\Livewire\Pages\Employee\Task\CompletedTask;
use App\Livewire\Pages\Employee\Task\EditTask as EmployeeTaskEdit;
use App\Livewire\Pages\Employee\Task\ViewTask;
use App\Livewire\Pages\Owner\AssignTask\CreateTask;
use App\Livewire\Pages\Owner\AssignTask\EditTask;
use App\Livewire\Pages\Owner\AssignTask\IndexTask;
use App\Livewire\Pages\Owner\Dashboard as Owner;
use App\Livewire\Pages\Owner\ManageEmployee\CreateOwnersEmployee;
use App\Livewire\Pages\Owner\ManageEmployee\IndexOwnersEmployee;
use App\Livewire\Pages\Public\Index;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Index::class)->name('welcome');
Route::get('/login', LogIn::class)->name('login');
Route::get('/register', Register::class)->name('register');

Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('welcome');
})->name('logout')->middleware('auth');

//admin route

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', Admin::class)->name('admin.dashboard');

    Route::get('/roles/create', CreateRole::class)->name('admin.create.role');
    Route::get('/roles/{id}', EditRole::class)->name('admin.edit.role');
    Route::get('/roles', IndexRole::class)->name('admin.index.role');
    
    Route::get('/user/create', CreateUser::class)->name('admin.create.user');
    Route::get('/user/{id}', EditUser::class)->name('admin.edit.user');
    Route::get('/user', IndexUser::class)->name('admin.index.user');

    Route::get('/history/user', HistoryUser::class)->name('admin.history.user');
});

//shop owner route

Route::middleware(['auth', 'owner'])->prefix('owner')->group(function () {
    Route::get('/dashboard', Owner::class)->name('owner.dashboard');

    Route::get('/employee/list', IndexOwnersEmployee::class)->name('owner.employee.list');
    Route::get('/employee/create', CreateOwnersEmployee::class)->name('owner.employee.create');

    Route::get('/task/index', IndexTask::class)->name('owner.task.index');
    Route::get('/task/create', CreateTask::class)->name('owner.task.create');
    Route::get('/task/{id}', EditTask::class)->name('owner.task.edit');
});

//employee route

Route::middleware(['auth', 'employee'])->prefix('employee')->group(function () {
    Route::get('/dashboard', Employee::class)->name('employee.dashboard');

    Route::get('/task/index', ViewTask::class)->name('employee.task.index');
    Route::get('/task/completed', CompletedTask::class)->name('employee.task.completed');
    Route::get('/task/{id}', EmployeeTaskEdit::class)->name('employee.task.edit');
});
