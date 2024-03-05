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
Route::post('/income', [IncomeController::class, 'store'])->name('income.store');

Route::post('/income',  [IncomeController::class,'store'])->name('income.store');
Route::delete('/income/{id}',[IncomeController::class,'destroy'])->name('income.destroy');
Route::match(['get', 'put'], '/income/{id}', [IncomeController::class,'update'])->name('income.update');

Route::get('/incomeRe', [IncomeController::class,'getIncome'])->name('get-Income');
// Define a route to fetch income data and apply filters
Route::get('/incomeRe/data', 'IncomeController@getIncome')->name('income.data');

// You may also need a route for filtering expenses by month if not already defined
 Route::get('/incomeRe/filterByMonth', 'IncomeController@filterByMonth')->name('income.filterByMonth');
Route::post('/expence', [ExpencesController::class, 'store'])->name('expence.store');
Route::get('expence', [ExpencesController::class,'index'])->name('expence.index');
Route::post('/expence',  [ExpencesController::class,'store'])->name('expence.store');
Route::delete('/expence/{id}',[ExpencesController::class,'destroy'])->name('expence.destroy');
Route::match(['get', 'put'], '/expence/{id}', [ExpencesController::class,'update'])->name('expence.update');
Route::get('/filter', [ExpencesController::class, 'filterByMonth'])->name('expence.filterByMonth');


Route::get('/salary', [SalaryController::class, 'create'])->name('salary.create');
Route::get('/dashboard', SalaryController::class .'@store')->name('salary.store');
Route::post('/salary', [SalaryController::class, 'store'])->name('salary.store');
Route::get('/salary', [salaryController::class, 'display'])->name('salary.display');
//Route::get('/',[SalaryController::class,'cal'])->name('salary.cal');

Route::get('/subcategory/create', [SubCategoryController::class, 'create'])->name('subcategory.create');
Route::get('/dashboard', SubCategoryController::class .'@store')->name('subcategory.store');
Route::post('/subcategory', [SubCategoryController::class,'store'])->name('subcategory.store');
Route::get('/subcategory/create',[SubCategoryController::class,'index']);
Route::get('/subcategory', [SubCategoryController::class, 'display'])->name('sub.display');
//Route::post('/subcategory', [SubCategoryController::class, 'display']);

Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::get('/dashboard', CategoryController::class .'@store')->name('category.store');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category', [CategoryController::class, 'display'])->name('category.display');


Route::post('/assets/create', [AssetsController::class, 'create'])->name('assets.create');
Route::get('/dashboard', AssetsController::class .'@store')->name('assets.store');
Route::post('/assets', [AssetsController::class, 'store'])->name('assets.store');
Route::get('/assets/create',[AssetsController::class,'index']);
Route::get('/assets', [AssetsController::class, 'display'])->name('assets.display');
Route::get('/', function () {
    return view('welcome');
});
//Route::get('/dashboard',)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
