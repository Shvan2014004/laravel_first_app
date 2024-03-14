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
            return redirect('/income')->with('success', 'Success');
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
        $filteredData = Income::whereMonth('date', '=', $month)->get();
        $total = $filteredData->sum('amount');
        return view('reports/incomeReport', compact('filteredData', 'month','total'));
    }
    // Export data to CSV

    public function exportToCSV(Request $request)
    {

        $month = $request->input('month');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        if ($month) {
            $filteredData = Income::whereMonth('date', '=', $month)->get();
        } else {

            $filteredData = Income::whereBetween('date', [$startDate, $endDate])->get();
        }

        // Write data to CSV file
        $csvFileName = 'income_data.csv';
        $csvFile = fopen(public_path('exports/' . $csvFileName), 'w');

        // Write header
        fputcsv($csvFile, ['ID', 'Date', 'Description', 'Amount', 'Type']);

        // Write data
        foreach ($filteredData as $item) {
            fputcsv($csvFile, [$item->id, $item->date, $item->description, $item->amount, $item->type]);
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
            $filteredData = Income::whereMonth('date', '=', $month)->get();
            $html = view('reports.incomePDF', compact('filteredData', 'month'))->render();
        } else {

            $filteredData = Income::whereBetween('date', [$startDate, $endDate])->get();
            $html = view('reports.incomePDF', compact('filteredData', 'startDate', 'endDate'))->render();
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

        return view('reports.incomeReportDateRange', compact('filteredData', 'startDate', 'endDate'));
    }
}
