<?php

namespace App\Http\Controllers;
use App\Models\Expence;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    public function update(Request $request, $id)
    {
        $expence = Expence::findOrFail($id);
        $updated = $expence->update($request->all());
    
        if ($updated) {
            return redirect('/expence')->with('success', 'Data updated');
        } else {
            return redirect()->back()->with('error', 'Failed to update data');
        }
    }

    public function destroy( $id ) {
        $expence = Expence::findOrFail( $id );
        $expence->delete();
        return redirect( '/expence' )->with( 'success', 'Record deleted successfully' );
    }
    public function filterByMonth(Request $request)
    {
        $month = $request->input('month');
        $filteredData = Expence::whereMonth('date', '=', $month)->get();
        
        return view('reports/expenceReport', compact('filteredData'));
    }

}
