<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Income;
use App\Models\Salary;
use App\Models\Expence;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $start=$request->input('start');
        $end=$request->input('end');
        
        // $income = Income::whereBetween('date',[$start,$end])->get();
        $income = Income::all();
        $expence = Expence::all();
        $salary = Salary::all();
        $subcategory = Subcategory::all();
        $category = Category::all();
        $assets = Assets::all();

        $isAssets = $assets->isEmpty();
        $isIncome = $income->isEmpty();
        $isExpence = $expence->isEmpty();

        
        return (view('reports.balanceReport', compact(
            'income',
            'expence',
            'salary',
            'assets',
            'isAssets',
            'isIncome',
            'isExpence',

        )));
    }
}
