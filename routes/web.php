<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;

Route::get('/user-management', [UserManagementController::class, 'index'])->name('user-management');
Route::get('/user-management/create', [UserManagementController::class, 'create'])->name('user-management.create');
Route::post('/user-management', [UserManagementController::class, 'store'])->name('user-management.store');
Route::put('/user-management/{id}', [UserManagementController::class, 'update'])->name('user-management.update');
Route::delete('/user-management/{id}', [UserManagementController::class, 'destroy'])->name('user-management.destroy');
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
    return view('welcome');
});
