<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // $category = Category::all();
        // return view('forms.category', ['category' => $category]);
        $sub = Category::orderBy('id', 'desc')
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

        return view('forms.category', compact('salary', 'request'));
    }
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

        Category::create($request->all());
        return redirect()->route('category.create');
        Session::flash('success', 'Data has been successfully stored.');
    }

    public function display()
    {
        $sub = Category::all();
        return (view('forms.category', compact('sub')));
    }

    public function update(Request $request, $id)
    {
        $sub = Category::findOrFail($id);
        $updated = $sub->update($request->all());

        if ($updated) {
            return redirect('/category')->with('success', 'Data updated');
        } else {
            return redirect()->back()->with('error', 'Failed to update data');
        }
    }

    public function destroy($id)
    {
        $sub = Category::findOrFail($id);
        $sub->delete();
        return redirect('/category')->with('success', 'Record deleted successfully');
    }
}
