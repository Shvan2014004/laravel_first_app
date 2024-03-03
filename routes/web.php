<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\IncomeReportController;
use App\Http\Controllers\ExpencesController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;


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



Route::get('/salary/create', [SalaryController::class, 'create'])->name('salary.create');
Route::get('/dashboard', SalaryController::class .'@store')->name('salary.store');
Route::post('/salary', [SalaryController::class, 'store'])->name('salary.store');

Route::get('/subcategory/create', [SubCategoryController::class, 'create'])->name('subcategory.create');
Route::get('/dashboard', SubCategoryController::class .'@store')->name('subcategory.store');
Route::post('/subcategory', [SubCategoryController::class,'store'])->name('subcategory.store');
Route::get('/subcategory/create',[SubCategoryController::class,'index']);
Route::get('/subcategory', [SubCategoryController::class, 'display'])->name('sub.display');
//Route::post('/subcategory', [SubCategoryController::class, 'display']);

Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::get('/dashboard', CategoryController::class .'@store')->name('category.store');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');


Route::post('/assets/create', [AssetsController::class, 'create'])->name('assets.create');
Route::get('/dashboard', AssetsController::class .'@store')->name('assets.store');
Route::post('/assets', [AssetsController::class, 'store'])->name('assets.store');
Route::get('/assets/create',[AssetsController::class,'index']);
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
