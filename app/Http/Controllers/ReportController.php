<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Balance;
use App\Models\Income;
use App\Models\Salary;
use App\Models\Expence;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use DateTime;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Month;

use function PHPUnit\Framework\isNull;

class ReportController extends Controller
{


    public function filterByMonth(Request $request)
    {
        $month = $request->input('month');
        $dateTime = new DateTime();
        $dateTime->setDate(date('Y'), $month, 1); // Set the year and month
        $monthName = $dateTime->format('F');

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

        $sumexpence = $expence->sum('amount') + $salary->sum('netsalary');
        $sumincome = $income->sum('amount');

$monthString = strtotime($monthName);
$previousMonthDate = strtotime('-1 month', $monthString);
$previousMonth = date('F', $previousMonthDate);
        // $previousMonth = ($month == 1) ? 12 : ($month - 1);
        // $bfincome = Income::whereMonth('date', '=', $previousMonth)->sum('amount');
        // $bfexpence = Expence::whereMonth('date', '=', $previousMonth)->sum('amount');
        // $bfsalary = Salary::whereMonth('salary_date', '=', $previousMonth)->sum('netsalary');
        $year='2024';
        $dateString = strtotime($previousMonth . ' ' . $year);
        $previousDate = date("Y-m-t", $dateString);
// Retrieve the balance data for the previous month
$rbf = Balance::where('date', '=', $previousDate)->first();
// dd($rbf);
// Calculate the beginning balance
$bf = $rbf ? $rbf->balance:0;
// dd($bf);
        // $rbf = Balance::where('date','=',$previousDate)->get();
        // dd($rbf);
// $bf=$rbf->value('balance');
        $balance = $bf + $sumincome - $sumexpence;
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
            'sumexpence',
            'bf',
            'monthName',
            'previousDate'

        )));
    }
    
    public function filterByDate(Request $request) {
        $date = $request->input('date');

        $income = Income::where('date', '=', $date)->get();
        $expence = Expence::where('date', '=', $date)->get();
        $salary = Salary::where('salary_date', '=', $date)->get();

        $sumexpence = $expence->sum('amount') + $salary->sum('netsalary');
        $sumincome = $income->sum('amount');

        $isIncome = $income->isEmpty();
        $isExpence = $expence->isEmpty();
        $isSalary = $salary->isEmpty();
    
        $previousDate = new DateTime($date);
        $previousDate->modify('-1 day');
        $previousDate = $previousDate->format('Y-m-d');
    
        $calbf = Balance::where('date', '=', $previousDate)->value('balance');
        $storebf=Balance::where('date','=',$date)->get();
    $bf=0;
        // Check if $date is null
        if ($date) {
            // if ($calbf==!null) {
            //     $bf=0;
            //     $balance = $bf + $sumincome - $sumexpence;
            //     // Create a new balance record
            //     Balance::create([
            //         'balance' => $balance,
            //         'date' => $date
            //     ]);
            // } else {
                // Get the balance from the query result
                $bf=value($calbf);
                $balance = $bf + $sumincome - $sumexpence;
                Balance::create([
                    'balance' => $balance,
                    'date' => $date
                ]);
            // }
        }
    
        // $bf = $this->balanceCalc($request); // Call balanceCalc with $request parameter
    
        $balance = $bf + $sumincome - $sumexpence;
    
        return view('reports.balanceReportday', compact(
            'income',
            'expence',
            'salary',
            'isIncome',
            'isExpence',
            'date',
            'isSalary',
            'balance',
            'sumincome',
            'sumexpence',
            'bf'
        ));
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
            $date = $request->input('date');
            $income = Income::where('date', '=', $date)->get();
            $expence = Expence::where('date', '=', $date)->get();
            $salary = Salary::where('salary_date', '=', $date)->get();
            // $subcategory = Subcategory::where( 'date', '=', $month )->get();
            // $category = Category::where( 'date', '=', $month )->get();
            // $assets = Assets::where( 'date', '=', $month )->get();
            // $isAssets = $assets->isEmpty();
            $isIncome = $income->isEmpty();
            $isExpence = $expence->isEmpty();
            $isSalary = $salary->isEmpty();

            $sumexpence = $expence->sum('amount') + $salary->sum('netsalary');
            $sumincome = $income->sum('amount');


            $previousDate = new DateTime($date);
            $previousDate->modify('-1 day');
            $previousDate = $previousDate->format('Y-m-d');
            $bfincome = Income::where('date', '=', $previousDate)->sum('amount');
            $bfexpence = Expence::where('date', '=', $previousDate)->sum('amount');
            $bfsalary = Salary::where('salary_date', '=', $previousDate)->sum('netsalary');

            $bf = $bfincome - ($bfexpence + $bfsalary);
            $balance = $bf + $sumincome - $sumexpence;
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
        fputcsv($csvFile, ['B/F', $bf]);
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
        fputcsv($csvFile, ['Total', '', $sumincome, $sumexpence]);
        if ($balance > 0)
            fputcsv($csvFile, ['Balance', '', $balance, '']);
        else
            fputcsv($csvFile, ['Balance', '', '', $balance]);
        fclose($csvFile);

        // Download CSV file
        return response()->download(public_path('exports/' . $csvFileName));
    }

    public function exportToPDF(Request $request)
    {
        $month = $request->input('month');
        $dateTime = new DateTime();
        $dateTime->setDate(date('Y'), $month, 1); // Set the year and month
        $monthName = $dateTime->format('F'); // Get the month name

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

            $sumexpence = $expence->sum('amount') + $salary->sum('netsalary');
            $sumincome = $income->sum('amount');


            $previousMonth = ($month == 1) ? 12 : ($month - 1);
            $bfincome = Income::whereMonth('date', '=', $previousMonth)->sum('amount');
            $bfexpence = Expence::whereMonth('date', '=', $previousMonth)->sum('amount');
            $bfsalary = Salary::whereMonth('salary_date', '=', $previousMonth)->sum('netsalary');

            $bf = $bfincome - ($bfexpence + $bfsalary);
            if ($bfincome > ($bfexpence + $bfsalary))
                $balance = ($bf + $sumincome) - $sumexpence;
            else
                $balance = $sumincome - $sumexpence + $bf;

            $html = (view('reports.balancePDF', compact(
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
                'sumexpence',
                'bf',
                'monthName',
                'previousMonth'

            )))->render();
        } else {
            $date = $request->input('date');
            $income = Income::where('date', '=', $date)->get();
            $expence = Expence::where('date', '=', $date)->get();
            $salary = Salary::where('salary_date', '=', $date)->get();
            // $subcategory = Subcategory::where( 'date', '=', $month )->get();
            // $category = Category::where( 'date', '=', $month )->get();
            // $assets = Assets::where( 'date', '=', $month )->get();
            // $isAssets = $assets->isEmpty();
            $isIncome = $income->isEmpty();
            $isExpence = $expence->isEmpty();
            $isSalary = $salary->isEmpty();

            $sumexpence = $expence->sum('amount') + $salary->sum('netsalary');
            $sumincome = $income->sum('amount');


            $previousDate = new DateTime($date);
            $previousDate->modify('-1 day');
            $previousDate = $previousDate->format('Y-m-d');
            $bfincome = Income::where('date', '=', $previousDate)->sum('amount');
            $bfexpence = Expence::where('date', '=', $previousDate)->sum('amount');
            $bfsalary = Salary::where('salary_date', '=', $previousDate)->sum('netsalary');

            $bf = $bfincome - ($bfexpence + $bfsalary);
            $balance = $bf + $sumincome - $sumexpence;
            $html = (view('reports.balancePDF', compact(
                'income',
                'expence',
                'salary',
                // 'assets',
                // 'isAssets',
                'isIncome',
                'isExpence',
                'date',
                'isSalary',
                'balance',
                'sumincome',
                'sumexpence',
                'bf'

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
        $name = 'Accounts Report - ';
        if ($month >= 1 && $month <= 12) {
            $dateTime = new DateTime();
            $dateTime->setDate(date('Y'), $month, 1); // Set the year and month
            $monthName = $dateTime->format('F'); // Get the month name
            $filename = $name . $monthName;
        } else {
            $filename = $name . $date;
        }
        // Output the generated PDF to the browser ( download )
        return $dompdf->stream($filename);
    }

    public function filterByDateRange(Request $request)
    {
        $date = $request->input('date');
        // $endDate = $request->input('end_date');

        // Assuming your date column is named 'date'
        $income = Income::where('date', '=', [$date])->get();
        $expence = Expence::where('date', '=', [$date])->get();
        $salary = Salary::where('salary_date', '=', [$date])->get();
        // $subcategory = Subcategory::whereMonth( 'date', '=', [ $startDate, $endDate ] )->get();
        // $category = Category::whereMonth( 'date', '=', [ $startDate, $endDate ] )->get();
        // $assets = Assets::whereMonth( 'date', '=', [ $startDate, $endDate ] )->get();

        // $isAssets = $assets->isEmpty();
        $isIncome = $income->isEmpty();
        $isExpence = $expence->isEmpty();
        $isSalary = $salary->isEmpty();
        $sumexpence = $expence->sum('amount');
        $sumincome = $income->sum('amount');
        $balance = $sumincome - $sumexpence;

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
            'date',
            // 'endDate',
            'sumexpence',
            'sumincome',
            'balance',
        )))->render();
    }
}
