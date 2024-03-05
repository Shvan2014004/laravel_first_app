<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use Carbon\Carbon;
use DataTables;
use App\DataTables\IncomeDataTable;  


class IncomeController extends Controller {
  

     
     public function getIncome(Request $request, IncomeDataTable $dataTable)
     {
         $month = $request->input('month');
         $query = Income::query();
       
         if ($month) {
             $query->whereMonth('date', $month);
         }
     
         return $dataTable->with([
             'filteredData' => $query->get()
         ])->render('reports.incomeReport');
     }
    public function store( Request $request ) {
        $this->validate( $request, [
            'date' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'type' => 'required',
        ] );

        $income = Income::create( $request->all() );

        if ( $income ) {
            return redirect( '/income' )->with( 'success', 'Success' );
        } else {
            return back()->withInput()->with( 'error', 'Failed to save data' );
        }

    }

    public function update( Request $request, $id ) {
        $income = Income::findOrFail( $id );
        $this->validate( $request, [
            'date' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'type' => 'required',
        ] );
        $updated = $income->update( $request->all() );

        if ( $updated ) {
            return redirect( '/income' )->with( 'success', 'Data updated' );
        } else {
            return redirect()->back()->with( 'error', 'Failed to update data' );
        }
    }

    public function destroy( $id ) {
        $income = Income::findOrFail( $id );
        $income->delete();
        return redirect( '/income' )->with( 'success', 'Record deleted successfully' );
    }

}
