<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
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
        return view('pages.size.index',[
            'sizes'    => Size::all(),
        ]);
    }

    public function create(Size $size)
    {
        $this->authorize('create', $size);
        return view('pages.size.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $size = new Size;
        $size->name = $validatedData['name'];
        $size->author_id = auth()->user()->id;
        $size->save();
        return redirect()->route('size.index')->with('successct', 'size created successfully.');
    }

    public function edit(Size $size)
    {
        return view('pages.size.edit',[
            'size'    => $size,
            'sizes'    => Size::all(),
        ]);
    }

    public function update(Request $request, Size $size)
    {
        $this->authorize('update', $size);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $size->name = $validatedData['name'];
        $size->save();
        return redirect()->route('size.index')->with('successup', 'size updated successfully.');;
    }


    public function destroy(Size $size)
    {
        $this->authorize('delete', $size);
        $size->delete();
        return redirect()->route('size.index')->with('successdt', 'size deleted successfully.');;
    }
}
