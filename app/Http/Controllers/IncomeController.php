<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use Carbon\Carbon;

class IncomeController extends Controller {
    public function index( Request $request ) {
        $income = Income::orderBy( 'id', 'desc' )
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

        return view( 'forms.income', compact( 'income', 'request' ) );
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
