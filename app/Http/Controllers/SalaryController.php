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
        $request->validate([
            'salary_date' => ['required', 'date', 'max:255'],
            'empolyee_id' => ['required', 'string', 'lowercase', 'max:6'],
            'employee_name' => ['required','string', 'max:255' ],
            'no_of_workin_days' => ['required', 'max:31' ],
            'salary_per_day' => ['required', 'max:15' ],
            'deduction' => ['required', 'max:15' ],
            'netsalary' => ['required', 'max:15' ],
        ]);

        Salary::create($request->all());
          $data['date'] = Carbon::now();

        //event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
    }
}

