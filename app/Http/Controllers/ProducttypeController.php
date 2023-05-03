<?php

namespace App\Http\Controllers;

use App\Models\Producttype;
use Illuminate\Http\Request;

class ProducttypeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('pages.producttype.index',[
            'producttypes'    => Producttype::all(),
        ]);
    }

    public function create(Producttype $producttype)
    {
        $this->authorize('create', $producttype);
        return view('pages.producttype.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $producttype = new Producttype;
        $producttype->name = $validatedData['name'];
        $producttype->author_id = auth()->user()->id;
        $producttype->save();
        return redirect()->route('type-of-product.index')->with('successct', 'Producttype created successfully.');
    }

    public function edit(Producttype $producttype)
    {
        return view('pages.producttype.edit', compact('producttype'));
    }

    public function update(Request $request, Producttype $producttype)
    {
        $this->authorize('update', $producttype);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $producttype->name = $validatedData['name'];
        $producttype->save();
        return redirect()->route('type-of-product.index')->with('successup', 'Producttype updated successfully.');;
    }


    public function destroy(Producttype $producttype)
    {
        $this->authorize('delete', $producttype);
        $producttype->delete();
        return redirect()->route('form-of-product.index')->with('successdt', 'Producttype deleted successfully.');;
    }
}
