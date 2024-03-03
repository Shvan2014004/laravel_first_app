<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Assets;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subcategory;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class AssetsController extends Controller
{
    /**
     * Display the registration view.
     */
    public function index()
    {   
    $sub_category = Subcategory::all();
    return view('forms.assets', ['sub_category'=>$sub_category]);
    }
   

    public function create(): View
    {
        return view('forms.assets');
    }
    
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        

        Assets::create($request->all());

        // Assets::create([
        //     'description'=>$request->description,
        //     'amount'=>$request->amount,
        //     'sub_category_id'=>$request->sub_category_id,
        // ]);
        
          //$data['date'] = Carbon::now();

        //event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
    }
    public function display(){
        $data = Assets::all();
        return(view('forms.assetsdisplay',compact('data')));     
    }
}

