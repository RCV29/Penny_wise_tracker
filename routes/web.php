<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\AuthManager;
use Illuminate\Auth\AuthManager as AuthAuthManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SavingController;
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

Route::get('/', function () {return view('welcome');})->name('home');
Route::get('/dashboard', function (){ return view('dashboard');})->name('dashboard');

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile', function(){
        return "Hi";
    });
});

Route::controller(ExpenseController::class)->group(function () {
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/create', 'create')->name('expenses.create');
    Route::post('/expenses', 'store')->name('expenses.store');
    Route::get('/expenses/{expense}/edit', 'edit')->name('expenses.edit');
    Route::put('/expenses/{expense}', 'update')->name('expenses.update');
    Route::delete('/expenses/{expense}/delete', 'destroy')->name('expenses.destroy');
});


Route::controller(SavingController::class)->group(function () {
    Route::get('/savings', [SavingController::class, 'index'])->name('savings.index');
    Route::get('/savings/create', 'create')->name('saving.create');
    Route::post('/savings', 'store')->name('savings.store');
    Route::get('/savings/{saving}/edit', 'edit')->name('savings.edit');
    Route::put('/savings/{saving}', 'update')->name('savings.update');
    Route::delete('/savings/{saving}/delete', 'destroy')->name('savings.destroy');
});






