<?php

namespace App\Http\Controllers;

use App\Models\Fiscalyear;
use Illuminate\Http\Request;

class FiscalyearController extends Controller
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
        return view('pages.fiscalyear.index',[
            'fiscalyears'    => Fiscalyear::all(),
        ]);
    }

    public function create(Fiscalyear $fiscalyear)
    {
        $this->authorize('create', $fiscalyear);
        return view('pages.fiscalyear.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $fiscalyear = new Fiscalyear;
        $fiscalyear->name = $validatedData['name'];
        $fiscalyear->author_id = auth()->user()->id;
        $fiscalyear->save();
        return redirect()->route('fiscalyear.index')->with('successct', 'fiscalyear created successfully.');
    }

    public function edit(Fiscalyear $fiscalyear)
    {
        return view('pages.fiscalyear.edit',[
            'fiscalyear'    => $fiscalyear,
            'fiscalyears'    => Fiscalyear::all(),
        ]);
    }

    public function update(Request $request, Fiscalyear $fiscalyear)
    {
        $this->authorize('update', $fiscalyear);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $fiscalyear->name = $validatedData['name'];
        $fiscalyear->save();
        return redirect()->route('home')->with('fy', 'Fiscal year updated successfully.');;
    }


    public function destroy(Fiscalyear $fiscalyear)
    {
        $this->authorize('delete', $fiscalyear);
        $fiscalyear->delete();
        return redirect()->route('fiscalyear.index')->with('successdt', 'fiscalyear deleted successfully.');;
    }
}
