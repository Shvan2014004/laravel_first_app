<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ExpencesController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;
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

// Route::get('/reports', [ReportController::class, 'test'])->name('report');

// Route::post('/report',[ReportController::class,'index']);

// Route::post('/daily_report', [ReportController::class, 'balanceCalc'])->name('balance');
Route::match(['post','get'],'/daily_report', [ReportController::class, 'filterByDate'])->name('balance.daily');
Route::get('/report', [ReportController::class, 'filterByMonth'])->name('balance.filterByMonth');
Route::get('/expor/csv', [ReportController::class,'exportToCSV'])->name('balance.exportCSV');
Route::get('/expor/pdf',  [ReportController::class,'exportToPDF'])->name('balance.exportPDF');
Route::get('/dailyreport', [ReportController::class,'filterByDateRange'])->name('balance.filterByDateRange');

Route::get('/income', [IncomeController::class, 'index'])->name('income.index');
Route::post('/income',  [IncomeController::class,'store'])->name('income.store');
Route::delete('/income/{id}',[IncomeController::class,'destroy'])->name('income.destroy');
Route::match(['get', 'put'], '/income/{id}', [IncomeController::class,'update'])->name('income.update');
Route::get('/filterIncome', [IncomeController::class, 'filterByMonth'])->name('income.filterByMonth');
Route::get('/exports/csv', [IncomeController::class, 'exportToCSV'])->name('income.exportCSV');
Route::get('/exports/pdf',  [IncomeController::class,'exportToPDF'])->name('income.exportPDF');
Route::get('/filter-by-date-rangeIncome', [IncomeController::class,'filterByDateRange'])->name('income.filterByDateRange');

Route::get('expence', [ExpencesController::class,'index'])->name('expence.index');
Route::post('/expence',  [ExpencesController::class,'store'])->name('expence.store');
Route::delete('/expence/{id}',[ExpencesController::class,'destroy'])->name('expence.destroy');
Route::match(['get', 'put'], '/expence/{id}', [ExpencesController::class,'update'])->name('expence.update');
Route::get('/filter', [ExpencesController::class, 'filterByMonth'])->name('expence.filterByMonth');
Route::get('/export/csv', [ExpencesController::class,'exportToCSV'])->name('expence.exportCSV');
Route::get('/export/pdf',  [ExpencesController::class,'exportToPDF'])->name('expence.exportPDF');
Route::get('/filter-by-date-range', [ExpencesController::class,'filterByDateRange'])->name('expence.filterByDateRange');

Route::get('/salary', [SalaryController::class, 'create'])->name('salary.create');
Route::get('/dashboard', SalaryController::class .'@store')->name('salary.store');
Route::post('/salary', [SalaryController::class, 'store'])->name('salary.store');
Route::get('/salary', [salaryController::class, 'index'])->name('salary.index');
Route::delete('/salary/{id}',[SalaryController::class,'destroy'])->name('salary.destroy');
Route::match(['get', 'put'], '/salary/{id}', [SalaryController::class,'update'])->name('salary.update');
//Route::get('/',[SalaryController::class,'cal'])->name('salary.cal');

Route::get('/subcategory', [SubCategoryController::class, 'create'])->name('subcategory.create');
Route::get('/dashboard', SubCategoryController::class .'@store')->name('subcategory.store');
Route::post('/subcategory', [SubCategoryController::class,'store'])->name('subcategory.store');
Route::get('/subcategory', [SubCategoryController::class, 'display'])->name('subcategory.display');
Route::delete('/subcategory/{id}',[SubCategoryController::class,'destroy'])->name('subcategory.destroy');
Route::match(['get', 'put'], '/subcategory/{id}', [SubCategoryController::class,'update'])->name('subcategory.update');
//Route::post('/subcategory', [SubCategoryController::class, 'display']);

Route::get('/category', [CategoryController::class, 'create'])->name('category.create');
Route::get('/dashboard', CategoryController::class .'@store')->name('category.store');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category', [CategoryController::class, 'display'])->name('category.display');
Route::delete('/category/{id}',[CategoryController::class,'destroy'])->name('category.destroy');
Route::match(['get', 'put'], '/category/{id}', [CategoryController::class,'update'])->name('category.update');




Route::post('/assets',  [AssetsController::class,'store'])->name('assets.store');
Route::get('assets',[AssetsController::class,'display'])->name('assets.display');
Route::match(['get', 'put'], '/assets/{id}', [AssetsController::class,'update'])->name('assets.update');
Route::delete('/assets/{id}',[AssetsController::class,'destroy'])->name('assets.destroy');

Route::get('/login', function () {
    return view('login');
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
