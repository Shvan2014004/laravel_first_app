<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;

class SalaryController extends Controller
{
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
          $data['date'] = Carbon::now();

        //event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
    }
    // public function cal(){
    //     $sal->'no_of_workin_days';
    // }
    public function display(){
        $data = Salary::all();
        return(view('forms.salary',compact('data')));     
    }
    // public function cal(Request $request){
    //     $day=$request->input('no_of_workin_days');
    //     $sal=$request->input('salary_per_day');
    //     $ded=$request->input('deduction');
    //     $nsal=($day*$sal)-$ded;
    //     return $nsal;
    // }
}

