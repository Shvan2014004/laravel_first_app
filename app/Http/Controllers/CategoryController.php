<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('forms.category');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        

       // Category::create($request->all());

        Category::create([
            'category'=>$request->category,
        ]);
          //$data['date'] = Carbon::now();

        //event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
    }
    public function display(){
        $data = Category::all();
        return(view('forms.categorydisplay',compact('data')));     
    }
}

