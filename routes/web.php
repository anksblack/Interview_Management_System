<?php

use App\Http\Controllers\AuthorizeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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

Route::get('/', function () {
    return redirect(route('login'));
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user',                          UserController::class);
    Route::prefix('role')->group(function () {
        Route::post('/assign', [UserController::class, 'assignRoles'])->name('assignRole');
    });
    Route::resource('role',                            RoleController::class);
    Route::resource('interviews',                     InterviewController::class);
    Route::resource('modules', ModuleController::class);
    Route::resource('permission',                            PermissionController::class);
    Route::get('interviews/{interview}/feedback', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('interviews/{interview}/feedback',    [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
