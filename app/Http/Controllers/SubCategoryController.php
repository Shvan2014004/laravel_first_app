<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\View\View;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class SubCategoryController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('forms.subcategory');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

     public function index()
    {   
    $category = Category::all();
    return view('forms.subcategory', ['category'=>$category]);
    }

    public function store(Request $request)
    {
        
        Subcategory::create($request->all());
        return redirect()->route('sub.display');
        Session::flash('success', 'Data has been successfully stored.');
    }

    public function display(){
        $data = Subcategory::all();
        return(view('forms.subdisplay',compact('data')));     
    }
}

