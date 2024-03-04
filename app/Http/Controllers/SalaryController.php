<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpencesController extends Controller {
    public function index( Request $request ) {
        $expence = Salary::orderBy( 'id', 'desc' )
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

        return view( 'salary.index', compact( 'salary', 'request' ) );
    }

    public function store( Request $request ) {
        $this->validate( $request, [
            'salary_date' => 'required',
            'employee_id' => 'required',
            'employee_name' => 'required',
            'salary_per_day' => 'required',
            'no_of_workin_days' => 'required',
            'deduction' => 'required',
            'netsalary' => 'required',
        ] );

        $expence = Salary::create( $request->all() );

        if ( $expence ) {
            return redirect( '/expence' )->with( 'success', 'Success' );
        } else {
            return back()->withInput()->with( 'error', 'Failed to save data' );
        }

    }

    public function update(Request $request, $id)
    {
        $expence = Salary::findOrFail($id);
        $updated = $expence->update($request->all());
    
        if ($updated) {
            return redirect('/salary')->with('success', 'Data updated');
        } else {
            return redirect()->back()->with('error', 'Failed to update data');
        }
    }

    public function destroy( $id ) {
        $expence = Salary::findOrFail( $id );
        $expence->delete();
        return redirect( '/salary' )->with( 'success', 'Record deleted successfully' );
    }

}
