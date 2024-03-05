<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\subcategory;
use Illuminate\Support\Facades\Session;


class AssetsController extends Controller
{
    
    /**
     * Display the registration view.
     */
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
        $this->validate($request, [
            'description' => 'required',
            'amount' => 'required',
            'sub_category' => 'required',

        ]);

        //  Assets::create($request->all());
        //  Session::flash('success', 'Data has been successfully stored.');
        // return redirect('/subcategory')->with( 'success', 'Success' );
        
        $expence = Assets::create( $request->all() );

        if ( $expence ) {
            return redirect( '/assets' )->with( 'success', 'Success' );
        } else {
            return back()->withInput()->with( 'error', 'Failed to save data' );
        }
    }

    public function display()
    {
        $category = SubCategory::all();
        // return view('forms.subcategory', ['category' => $category]);   
        $sub = Assets::all();
        return (view('forms.assets', compact('sub','category')));
    }

    public function update(Request $request, $id)
    {
        $sub = Assets::findOrFail($id);
        $updated = $sub->update($request->all());

        if ($updated) {
            return redirect('/assets')->with('success', 'Data updated');
        } else {
            return redirect()->back()->with('error', 'Failed to update data');
        }
    }

    public function destroy($id)
    {
        $sub = Assets::findOrFail($id);
        $sub->delete();
        return redirect('/assets')->with('success', 'Record deleted successfully');
    }
    // public function retrive(){
    //     $sub_cat=Subcategory::all();
    //     return view('forms.assets',compact('sub_cat'));
    // }
}
