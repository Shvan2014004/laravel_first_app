<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Salary;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class SalaryController extends Controller
{
    public function index(Request $request)
    {
        $salary = Salary::orderBy('id', 'desc')
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

        return view('forms.salary', compact('salary', 'request'));
    }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('forms.salary');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {


        Salary::create($request->all());
        $salary['date'] = Carbon::now();

        $salary = Salary::create($request->all());

        if ($salary) {
            return redirect('/salary')->with('success', 'Success');
        } else {
            return back()->withInput()->with('error', 'Failed to save data');
        }
    }
    // public function cal(){
    //     $sal->'no_of_workin_days';
    // }
    public function display()
    {
        $salary = Salary::all();
        return (view('forms.salary', compact('salary')));
    }


    public function update(Request $request, $id)
    {
        $salary = Salary::findOrFail($id);
        $updated = $salary->update($request->all());

        if ($updated) {
            return redirect('/salary')->with('success', 'Data updated');
        } else {
            return redirect()->back()->with('error', 'Failed to update data');
        }
    }

    public function destroy($id)
    {
        $salary = Salary::findOrFail($id);
        $salary->delete();
        return redirect('/salary')->with('success', 'Record deleted successfully');
    }
}
