<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\IncomeReportController;
use App\Http\Controllers\ExpencesController;
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
Route::post('/', IncomeController::class .'@index')->name('income.index');
Route::get('/income/create', [IncomeController::class, 'create'])->name('income.create');

Route::post('/income', [IncomeController::class, 'store'])->name('income.store');
Route::post('/expence', [ExpencesController::class, 'store'])->name('expence.store');

Route::get('/incomeReport', [IncomeReportController::class, 'index']);

Route::get('expence', [ExpencesController::class,'index'])->name('expence.index');
Route::post('/expence',  [ExpencesController::class,'store'])->name('expence.store');
Route::delete('/expence/{id}',[ExpencesController::class,'destroy'])->name('expence.destroy');
Route::match(['get', 'put'], '/expence/{id}', [ExpencesController::class,'update'])->name('expence.update');




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
