<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
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
        return view('pages.agency.index',[
            'agencies'    => Agency::all(),
        ]);
    }

    public function create(Agency $agency)
    {
        $this->authorize('create', $agency);
        return view('pages.agency.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'adddress' => 'required',
            'description' => 'required',
        ]);
        $agency = new Agency;
        $agency->name = $validatedData['name'];
        $agency->address = $request->address;
        $agency->description = $request->description;
        $agency->author_id = auth()->user()->id;
        $agency->save();
        return redirect()->route('agency.index')->with('successct', 'Agency created successfully.');
    }

    public function edit(Agency $agency)
    {
        return view('pages.agency.edit', compact('agency'));
    }

    public function update(Request $request, Agency $agency)
    {
        $this->authorize('update', $agency);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'adddress' => 'required',
            'description' => 'required',
        ]);
        $agency->name = $validatedData['name'];
        $agency->address = $request->address;
        $agency->description = $request->description;
        $agency->save();
        return redirect()->route('agency.index')->with('successup', 'Agency updated successfully.');;
    }


    public function destroy(Agency $agency)
    {
        $this->authorize('delete', $agency);
        $agency->delete();
        return redirect()->route('agency.index')->with('successdt', 'Agency deleted successfully.');;
    }
}
