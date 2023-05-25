<?php

namespace App\Http\Controllers;

use App\Models\Capital;
use Illuminate\Http\Request;

class CapitalController extends Controller
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
        return view('pages.capital.index',[
            'capitals'    => Capital::all(),
        ]);
    }

    public function create(Capital $capital)
    {
        $this->authorize('create', $capital);
        return view('pages.capital.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $capital = new Capital;
        $capital->name = $validatedData['name'];
        $capital->amount = $request->amount;
        $capital->author_id = auth()->user()->id;
        $capital->save();
        return redirect()->route('capital.index')->with('successct', 'capital created successfully.');
    }

    public function edit(Capital $capital)
    {
        return view('pages.capital.edit', [
            'capital' => $capital,
            'capitals'    => Capital::all(),
        ]);
    }

    public function update(Request $request, Capital $capital)
    {
        $this->authorize('update', $capital);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $capital->name = $validatedData['name'];
        $capital->amount = $request->amount;
        $capital->save();
        return redirect()->route('capital.index')->with('successup', 'capital updated successfully.');;
    }


    public function destroy(Capital $capital)
    {
        $this->authorize('delete', $capital);
        $capital->delete();
        return redirect()->route('capital.index')->with('successdt', 'capital deleted successfully.');;
    }
}
