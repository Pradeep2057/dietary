<?php

namespace App\Http\Controllers;

use App\Models\Productform;
use Illuminate\Http\Request;

class ProductformController extends Controller
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
        return view('pages.productform.index',[
            'productforms'    => Productform::all(),
        ]);
    }

    public function create(Productform $productform)
    {
        $this->authorize('create', $productform);
        return view('pages.productform.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $productform = new Productform;
        $productform->name = $validatedData['name'];
        $productform->author_id = auth()->user()->id;
        $productform->save();
        return redirect()->route('form-of-product.index')->with('successct', 'Productform created successfully.');
    }

    public function edit(Productform $productform)
    {
        return view('pages.productform.edit',[
            'productform'    => $productform,
            'productforms'    => Productform::all(),
        ]);
    }

    public function update(Request $request, Productform $productform)
    {
        $this->authorize('update', $productform);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $productform->name = $validatedData['name'];
        $productform->save();
        return redirect()->route('form-of-product.index')->with('successup', 'Productform updated successfully.');;
    }


    public function destroy(Productform $productform)
    {
        $this->authorize('delete', $productform);
        $productform->delete();
        return redirect()->route('form-of-product.index')->with('successdt', 'Productform deleted successfully.');;
    }
}
