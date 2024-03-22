<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Expence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Exports\ExpenceExport;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;

class ExpencesController extends Controller {
    public function index( Request $request ) {
        $expence = Expence::orderBy( 'id', 'desc' )
        ->when(
            $request->date_from && $request->date_to,

            function ( Builder $builder ) use ( $request ) {
                $builder->whereBetween(
                    DB::raw( 'DATE(created_at)' ),
                    [
                        $request->date_from,
                        $request->date_to
                    ]
                );
            }
        )->paginate( 5 );

        return view( 'forms.expence', compact( 'expence', 'request' ) );
    }

    public function store( Request $request ) {
        $this->validate( $request, [
            'date' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'type' => 'required',
        ] );

        $expence = Expence::create( $request->all() );

        if ( $expence ) {
            return redirect( '/expence' )->with( 'success', 'Success' );
        } else {
            return back()->withInput()->with( 'error', 'Failed to save data' );
        }

    }

    public function update( Request $request, $id ) {
        $expence = Expence::findOrFail( $id );
        $updated = $expence->update( $request->all() );

        if ( $updated ) {
            return redirect( '/expence' )->with( 'success', 'Data updated' );
        } else {
            return redirect()->back()->with( 'error', 'Failed to update data' );
        }
    }

    public function destroy( $id ) {
        $expence = Expence::findOrFail( $id );
        $expence->delete();
        return redirect( '/expence' )->with( 'success', 'Record deleted successfully' );
    }

    public function filterByMonth( Request $request ) {
        $month = $request->input( 'month' );

        $dateTime = new DateTime();
        $dateTime->setDate(date('Y'), $month, 1); // Set the year and month
        $monthName = $dateTime->format('F');

        $filteredData = Expence::whereMonth( 'date', '=', $month )->get();
        $total=$filteredData->sum('amount');
        $n=1;
        return view( 'reports/expenceReport', compact( 'filteredData', 'month','total' ,'n') );
    }
    // Export data to CSV

    public function exportToCSV( Request $request ) {

        $month = $request->input( 'month' );
        $startDate = $request->input( 'start_date' );
        $endDate = $request->input( 'end_date' );
        $n=1;
        if ( $month ) {
            $filteredData = Expence::whereMonth( 'date', '=', $month )->get();
            $total=$filteredData->sum('amount');
        } else {

            $filteredData = Expence::whereBetween( 'date', [ $startDate, $endDate ] )->get();
            $total=$filteredData->sum('amount');

        }

        // Write data to CSV file
        $csvFileName = 'expence_data.csv';
        $csvFile = fopen( public_path( 'exports/' . $csvFileName ), 'w' );

        // Write header
        fputcsv( $csvFile, [ 'ID', 'Date', 'Description', 'Amount', 'Type' ] );

        // Write data
        foreach ( $filteredData as $item ) {
            fputcsv( $csvFile, [ $n++, $item->date, $item->description, $item->amount, $item->type ] );
        }

        fclose( $csvFile );

        // Download CSV file
        return response()->download( public_path( 'exports/' . $csvFileName ) );
    }

    public function exportToPDF( Request $request ) {
        $month = $request->input( 'month' );
        $dateTime = new DateTime();
        $dateTime->setDate(date('Y'), $month, 1); // Set the year and month
        $monthName = $dateTime->format('F');

        $startDate = $request->input( 'start_date' );
        $endDate = $request->input( 'end_date' );
        $n=1;
        if ( $month ) {
            $filteredData = Expence::whereMonth( 'date', '=', $month )->get();
            $total=$filteredData->sum('amount');
            $html = view( 'reports.expencePDF', compact( 'filteredData', 'month','n','total','monthName' ) )->render();
        } else {

            $filteredData = Expence::whereBetween( 'date', [ $startDate, $endDate ] )->get();
            $total=$filteredData->sum('amount');
            $html = view( 'reports.expencePDF', compact( 'filteredData', 'startDate', 'endDate','n','total' ) )->render();

        }
        // Create a new DOMPDF instance
        $dompdf = new Dompdf();

        // Load HTML to DOMPDF
        $dompdf->loadHtml( $html );

        // Set paper size and orientation
        $dompdf->setPaper( 'A4', 'portrait' );

        // Render the HTML as PDF
        $dompdf->render();
        $name = 'Expence Report - ';
        if ($month >= 1 && $month <= 12) {
             // Get the month name
            $filename = $name . $monthName;
        } else {
            $filename = $name . $startDate . " to " . $endDate;
        }
        // Output the generated PDF to the browser ( download )
        return $dompdf->stream($filename);

   
    }

    public function filterByDateRange( Request $request ) {
        $startDate = $request->input( 'start_date' );
        $endDate = $request->input( 'end_date' );
        $n=1;
        // Assuming your date column is named 'date'
        $filteredData = Expence::whereBetween( 'date', [ $startDate, $endDate ] )->get();
        $total=$filteredData->sum('amount');
        return view( 'reports.expenceDateRangeReport', compact( 'filteredData', 'startDate', 'endDate' ,'n','total') );
    }
}
