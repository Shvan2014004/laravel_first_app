<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Income;
use App\Models\Salary;
use App\Models\Expence;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');

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
    public function filterByMonth(Request $request)
    {
        $month = $request->input('month');
        $income = Income::whereMonth('date', '=', $month)->get();
        $expence = Expence::whereMonth('date', '=', $month)->get();
        $salary = Salary::whereMonth('salary_date', '=', $month)->get();
        // $subcategory = Subcategory::whereMonth( 'date', '=', $month )->get();
        // $category = Category::whereMonth( 'date', '=', $month )->get();
        // $assets = Assets::whereMonth( 'date', '=', $month )->get();

        // $isAssets = $assets->isEmpty();
        $isIncome = $income->isEmpty();
        $isExpence = $expence->isEmpty();
        $isSalary = $salary->isEmpty();
        $sumexpence = $expence->sum('amount');
        $sumincome = $income->sum('amount');
        $balance = $sumincome-$sumexpence;
        

        return (view('reports.balanceReport', compact(
            'income',
            'expence',
            'salary',
            // 'assets',
            // 'isAssets',
            'isIncome',
            'isExpence',
            'month',
            'isSalary',
            'balance',
            'sumincome',
            'sumexpence'

        )));
    }
    // Export data to CSV

    public function exportToCSV(Request $request)
    {

        $month = $request->input('month');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        if ($month) {
            $income = Income::whereMonth('date', '=', $month)->get();
            $expence = Expence::whereMonth('date', '=', $month)->get();
            $salary = Salary::whereMonth('salary_date', '=', $month)->get();
            // $subcategory = Subcategory::whereMonth( 'date', '=', $month )->get();
            // $category = Category::whereMonth( 'date', '=', $month )->get();
            // $assets = Assets::whereMonth( 'date', '=', $month )->get();
        } else {
            $income = Income::whereBetween('date', [$startDate, $endDate])->get();
            $expence = Expence::whereBetween('date', [$startDate, $endDate])->get();
            $salary = Salary::whereBetween('date', [$startDate, $endDate])->get();
            // $subcategory = Subcategory::whereBetween( 'date', [ $startDate, $endDate ] )->get();
            // $category = Category::whereBetween( 'date', [ $startDate, $endDate ] )->get();
            // $assets = Assets::whereBetween( 'date', [ $startDate, $endDate ] )->get();
            // $filteredData = Income::whereBetween( 'date', [ $startDate, $endDate ] )->get();

        }

        // Write data to CSV file
        $csvFileName = 'Report_data.csv';
        $csvFile = fopen(public_path('exports/' . $csvFileName), 'w');

        // Write header
        fputcsv($csvFile, ['Date', 'Description', 'Credit', 'Debit']);
        fputcsv($csvFile, ['Income']);
        // Write data
        fputcsv($csvFile, ['Assets']);
        // Write data
        // foreach ( $assets as $item ) {
        //     fputcsv( $csvFile, [ $item->date, $item->description, $item->amount,"" ] );
        // }

        foreach ($income as $item) {
            fputcsv($csvFile, [$item->date, $item->description, $item->amount, ""]);
        }

        fputcsv($csvFile, ['Expense']);
        // Write data
        foreach ($expence as $item) {
            fputcsv($csvFile, [$item->date, $item->description, "", $item->amount]);
        }
        foreach ($salary as $item) {
            fputcsv($csvFile, [$item->salary_date, $item->description, "", $item->netsalary]);
        }
        fclose($csvFile);

        // Download CSV file
        return response()->download(public_path('exports/' . $csvFileName));
    }

    public function exportToPDF(Request $request)
    {
        $month = $request->input('month');

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($month) {
            $income = Income::whereMonth('date', '=', $month)->get();
            $expence = Expence::whereMonth('date', '=', $month)->get();
            $salary = Salary::whereMonth('salary_date', '=', $month)->get();
            // $subcategory = Subcategory::whereMonth( 'date', '=', $month )->get();
            // $category = Category::whereMonth( 'date', '=', $month )->get();
            // $assets = Assets::whereMonth( 'date', '=', $month )->get();

            // $isAssets = $assets->isEmpty();
            $isIncome = $income->isEmpty();
            $isExpence = $expence->isEmpty();
            $isSalary = $salary->isEmpty();
            $sumexpence = $expence->sum('amount');

            $html = (view('reports.balanceReport', compact(
                'income',
                'expence',
                'salary',
                // 'assets',
                // 'isAssets',
                'isIncome',
                'isExpence',
                'month',
                'isSalary',
                'sumexpence',
            )))->render();
        } else {
            $income = Income::whereBetween('date', '=', [$startDate, $endDate])->get();
            $expence = Expence::whereBetween('date', '=', [$startDate, $endDate])->get();
            $salary = Salary::whereBetween('salary_date', '=', [$startDate, $endDate])->get();
            // $subcategory = Subcategory::whereMonth( 'date', '=', [ $startDate, $endDate ] )->get();
            // $category = Category::whereMonth( 'date', '=', [ $startDate, $endDate ] )->get();
            // $assets = Assets::whereMonth( 'date', '=', [ $startDate, $endDate ] )->get();

            // $isAssets = $assets->isEmpty();
            $isIncome = $income->isEmpty();
            $isExpence = $expence->isEmpty();
            $isSalary = $salary->isEmpty();
            $sumexpence = $expence->sum('amount');

            $html = (view('reports.balanceReport', compact(
                'income',
                'expence',
                'salary',
                // 'assets',
                // 'isAssets',
                'isIncome',
                'isExpence',
                'month',
                'isSalary',
                'startDate',
                'endDate',
            )))->render();
        }
        // Create a new DOMPDF instance
        $dompdf = new Dompdf();

        // Load HTML to DOMPDF
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to the browser ( download )
        return $dompdf->stream('income_data.pdf');
    }

    public function filterByDateRange(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Assuming your date column is named 'date'
        $filteredData = Income::whereBetween('date', [$startDate, $endDate])->get();

        return view('reports.balanceDateRangeReport', compact('filteredData', 'startDate', 'endDate'));
    }
}
