<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
/*
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

Route::get('/register', [AuthController::class, 'register'])
    ->middleware('guest')
    ->name('register');
Route::get('/', [ContactController::class, 'showForm'])->name('contacts.form');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
Route::post('/store', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contacts.thanks');
Route::post('/back', [ContactController::class, 'back'])->name('contacts.back');
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/export', [DashboardController::class, 'export'])->name('export');
    Route::delete('/contacts/{id}', [DashboardController::class, 'destroy'])->name('delete');
    Route::get('/contacts/{id}', [DashboardController::class, 'show'])->name('show'); // ← モーダル用API
});
