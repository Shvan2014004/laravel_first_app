<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\IncomeDataTable;
use Illuminate\Database\Query\Builder;
use App\Exports\IncomeExport;
use Psy\Readline\Hoa\Console;
use Dompdf\Dompdf;
use Dompdf\Options;
use DateTime;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $income = Income::orderBy('id', 'desc')
            ->when(
                $request->date_from && $request->date_to,
                function (Builder $builder) use ($request) {
                    $builder->whereBetween(
                        DB::raw('DATE(created_at)'),
                        [
                            $request->date_from,
                            $request->date_to
                        ]
                    );
                }
            )->paginate(5);

        return view('forms.income', compact('income', 'request'));
    }



    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'type' => 'required',
        ]);

        $income = Income::create($request->all());

        if ($income) {
            return redirect('/income')->with('success', 'Income data successfully added');
        } else {
            return back()->withInput()->with('error', 'Failed to save data');
        }
    }

    public function update(Request $request, $id)
    {
        $income = Income::findOrFail($id);
        $this->validate($request, [
            'date' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'type' => 'required',
        ]);
        $updated = $income->update($request->all());

        if ($updated) {
            return redirect('/income')->with('success', 'Data updated');
        } else {
            return redirect()->back()->with('error', 'Failed to update data');
        }
    }

    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->delete();
        return redirect('/income')->with('success', 'Record deleted successfully');
    }

    public function filterByMonth(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year'); // Assuming year is also provided in the request
        $filteredData = Income::whereYear('date', '=', $year)
                              ->whereMonth('date', '=', $month)
                              ->get();
        $total = $filteredData->sum('amount');
        $n = 1;
        $dateTime = new DateTime();
        $dateTime->setDate($year, $month, 1); // Set the year and month
        $monthName = $dateTime->format('F');
        return view('reports.incomeReport', compact(
            'filteredData',
            'month',
            'year',
            'total',
            'n',
            'monthName'
        ));
    }
    // Export data to CSV

    public function exportToCSV(Request $request)
    {

        $month = $request->input('month');
        $year = $request->input('year');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $n = 1;
        if ($month&&$year) {
            $filteredData = Income::whereYear('date', $year)->whereMonth('date', $month)->get();
        } else {

            $filteredData = Income::whereBetween('date', [$startDate, $endDate])->get();
        }
        $total = $filteredData->sum('amount');
        // Write data to CSV file
        $csvFileName = 'Income_Report .csv';
        $csvFile = fopen(public_path('exports/' . $csvFileName), 'w');

        // Write header
        fputcsv($csvFile, ['ID', 'Date', 'Description', 'Amount', 'Type']);

        // Write data
        foreach ($filteredData as $item) {
            fputcsv($csvFile, [$n++, $item->date, $item->description, $item->amount, $item->type]);
        }
        fputcsv($csvFile, ['Total', '', '', $total, '']);

        fclose($csvFile);

        // Download CSV file
        return response()->download(public_path('exports/' . $csvFileName));
    }

    public function exportToPDF(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $n = 1;
        $dateTime = new DateTime();
        $dateTime->setDate(date('Y'), $month, 1); // Set the year and month
        $monthName = $dateTime->format('F');

        if ($month && $year) {
            $filteredData = Income::whereYear('date', $year)->whereMonth('date', '=', $month)->get();
            $total = $filteredData->sum('amount');
            $html = view('reports.incomePDF', compact('filteredData', 'month','year', 'n', 'total', 'monthName'))->render();
        } else {

            $filteredData = Income::whereBetween('date', [$startDate, $endDate])->get();
            $total = $filteredData->sum('amount');
            $html = view('reports.incomePDF', compact('filteredData', 'startDate', 'endDate', 'n', 'total'))->render();
        }

        // Create a new DOMPDF instance
        $dompdf = new Dompdf();

        // Load HTML to DOMPDF
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        $name = 'Income Report - ';
        if ($month >= 1 && $month <= 12) {
            $dateTime = new DateTime();
            $dateTime->setDate(date('Y'), $month, 1); // Set the year and month
            $monthName = $dateTime->format('F');            
            $filename = $name . $monthName . '_' . $year;
        } else {
            $filename = $name . $startDate . " to " . $endDate;
        }
        // Output the generated PDF to the browser ( download )
        return $dompdf->stream($filename);
    }

    public function filterByDateRange(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $n = 1;
        // Assuming your date column is named 'date'
        $filteredData = Income::whereBetween('date', [$startDate, $endDate])->get();
        $total = $filteredData->sum('amount');
        return view('reports.incomeReportDateRange', compact(
            'filteredData',
            'startDate',
            'endDate',
            'n',
            'total'
        ));
    }
}
