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

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class ReportController extends Controller
{


    public function filterByMonth(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        $dateTime = new DateTime();
        $dateTime->setDate(date('Y'), $month, 1); // Set the year and month
        $monthName = $dateTime->format('F');
        // dd($year);
        $income = Income::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->get();
        $expence = Expence::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->get();
        $salary = Salary::whereYear('salary_date', '=', $year)->whereMonth('salary_date', '=', $month)->get();
        // $subcategory = Subcategory::whereMonth( 'date', '=', $month )->get();
        // $category = Category::whereMonth( 'date', '=', $month )->get();
        // $assets = Assets::whereMonth( 'date', '=', $month )->get();
        // $isAssets = $assets->isEmpty();
        $isIncome = $income->isEmpty();
        $isExpence = $expence->isEmpty();
        $isSalary = $salary->isEmpty();



        $monthString = strtotime($monthName);
        $previousMonthDate = strtotime('-1 month', $monthString);
        $previousMonth = date('F', $previousMonthDate);
        $dateString = strtotime($previousMonth . ' ' . $year);
        $previousDate = date("Y-m-t", $dateString);
        // Retrieve the balance data for the previous month
        $rbf = Balance::where('date', '=', $previousDate)->first();

        // Calculate the beginning balance
        $bf = $rbf ? $rbf->balance : 0;
        //Calculate total
        $sumexpence = $expence->sum('amount') + $salary->sum('netsalary');
        $sumincome = $bf + $income->sum('amount');

        $balance = $sumincome - $sumexpence;
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
            'previousDate',
            'year'

        )));
    }

    public function filterByDate(Request $request)
    {
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
        $storebf = Balance::where('date', '=', $date)->get();
        $bf = 0;
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
            $bf = value($calbf);

           //Calculate total
        $sumexpence = $expence->sum('amount') + $salary->sum('netsalary');
        $sumincome = $bf + $income->sum('amount');

        $balance = $sumincome - $sumexpence;
            Balance::create([
                'balance' => $balance,
                'date' => $date
            ]);
            // }
            //Calculate total
        $sumexpence = $expence->sum('amount') + $salary->sum('netsalary');
        $sumincome = $bf + $income->sum('amount');

        $balance = $sumincome - $sumexpence;
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
        $date = $request->input('date');
        $month = $request->input('month');
        $year = $request->input('year');
        $dateTime = new DateTime();
        $dateTime->setDate(date('Y'), $month, 1); // Set the year and month
        $monthName = $dateTime->format('F');


        if ($month) {
            $income = Income::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->get();
            $expence = Expence::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->get();
            $salary = Salary::whereYear('salary_date', '=', $year)->whereMonth('salary_date', '=', $month)->get();
            // $subcategory = Subcategory::whereMonth( 'date', '=', $month )->get();
            // $category = Category::whereMonth( 'date', '=', $month )->get();
            // $assets = Assets::whereMonth( 'date', '=', $month )->get();

            $sumexpence = $expence->sum('amount') + $salary->sum('netsalary');
            $sumincome = $income->sum('amount');

            $monthString = strtotime($monthName);
            $previousMonthDate = strtotime('-1 month', $monthString);
            $previousMonth = date('F', $previousMonthDate);
            $dateString = strtotime($previousMonth . ' ' . $year);
            $previousDate = date("Y-m-t", $dateString);
            // Retrieve the balance data for the previous month
            $rbf = Balance::where('date', '=', $previousDate)->first();

            // Calculate the beginning balance
            $bf = $rbf ? $rbf->balance : 0;

            $balance = $bf + $sumincome - $sumexpence;
        } else {
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
            $storebf = Balance::where('date', '=', $date)->get();
            $bf = 0;
            // Check if $date is null
            if ($date) {

                $bf = value($calbf);
                $balance = $bf + $sumincome - $sumexpence;
            }
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
        $monthName = $dateTime->format('F');
        // $bool=isset($month);
        // dd($year,$month);
        if (isset($month)) {
            $year = $request->input('year');
            $income = Income::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->get();
            $expence = Expence::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->get();
            $salary = Salary::whereYear('salary_date', '=', $year)->whereMonth('salary_date', '=', $month)->get();
            // $subcategory = Subcategory::whereMonth( 'date', '=', $month )->get();
            // $category = Category::whereMonth( 'date', '=', $month )->get();
            // $assets = Assets::whereMonth( 'date', '=', $month )->get();
            // $isAssets = $assets->isEmpty();
            $isIncome = $income->isEmpty();
            $isExpence = $expence->isEmpty();
            $isSalary = $salary->isEmpty();

            $monthString = strtotime($monthName);
            $previousMonthDate = strtotime('-1 month', $monthString);
            $previousMonth = date('F', $previousMonthDate);
            $dateString = strtotime($previousMonth . ' ' . $year);
            $previousDate = date("Y-m-t", $dateString);
            // Retrieve the balance data for the previous month
            $rbf = Balance::where('date', '=', $previousDate)->first();

            // Calculate the beginning balance
            $bf = $rbf ? $rbf->balance : 0;

            //Calculate total
        $sumexpence = $expence->sum('amount') + $salary->sum('netsalary');
        $sumincome = $bf + $income->sum('amount');

        $balance = $sumincome - $sumexpence;
            // dd($sumincome,$sumexpence,$balance);

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
                'previousDate',
                'year'

            )))->render();
        } else {
            $date = $request->input('date');

            $income = Income::where('date', '=', $date)->get();
            $expence = Expence::where('date', '=', $date)->get();
            $salary = Salary::where('salary_date', '=', $date)->get();

            $isIncome = $income->isEmpty();
            $isExpence = $expence->isEmpty();
            $isSalary = $salary->isEmpty();

            $previousDate = new DateTime($date);
            $previousDate->modify('-1 day');
            $previousDate = $previousDate->format('Y-m-d');

            $calbf = Balance::where('date', '=', $previousDate)->value('balance');
            $storebf = Balance::where('date', '=', $date)->get();
            $bf = 0;
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
                $bf = value($calbf);
                $sumexpence = $expence->sum('amount') + $salary->sum('netsalary');
        $sumincome = $bf + $income->sum('amount');

        $balance = $sumincome - $sumexpence;
                $balance = $bf + $sumincome - $sumexpence;

                // }
            }

            // $bf = $this->balanceCalc($request); // Call balanceCalc with $request parameter

            //Calculate total
        
            // return "2";
            $html = view('reports.balancePDF', compact(
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
            ))->render();
        }
        // return "3";
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
            'date',
            // 'endDate',
            'sumexpence',
            'sumincome',
            'balance',
        )))->render();
    }
}
