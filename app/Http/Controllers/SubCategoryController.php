<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        // $category = Category::all();
        // return view('forms.subcategory', ['category' => $category]);
        $sub = Subcategory::orderBy('id', 'desc')
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

        return view('forms.subcategory', compact('sub', 'request'));
    }
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

        // Subcategory::create($request->all());
        // Session::flash('success', 'Data has been successfully stored.');
        // return redirect('/subcategory')->with( 'success', 'Success' );
        $expence = SubCategory::create( $request->all() );

        if ( $expence ) {
            return redirect( '/subcategory' )->with( 'success', 'Success' );
        } else {
            return back()->withInput()->with( 'error', 'Failed to save data' );
        }        

    }

    public function display()
    {
        $category = Category::all();
        // return view('forms.subcategory', ['category' => $category]);   
        $sub = Subcategory::all();
        return (view('forms.subcategory', compact('sub','category')));
    }

    public function update(Request $request, $id)
    {
        $sub = Subcategory::findOrFail($id);
        $updated = $sub->update($request->all());

        if ($updated) {
            return redirect('/subcategory')->with('success', 'Data updated');
        } else {
            return redirect()->back()->with('error', 'Failed to update data');
        }
    }

    public function destroy($id)
    {
        $sub = Subcategory::findOrFail($id);
        $sub->delete();
        return redirect('/subcategory')->with('success', 'Record deleted successfully');
    }
}
