<?php

namespace App\Http\Controllers;

use App\Models\Dose;
use Illuminate\Http\Request;

class DoseController extends Controller
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
        return view('pages.dose.index',[
            'doses'    => Dose::all(),
        ]);
    }

    public function create(Dose $dose)
    {
        $this->authorize('create', $dose);
        return view('pages.dose.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $dose = new Dose;
        $dose->name = $validatedData['name'];
        $dose->author_id = auth()->user()->id;
        $dose->save();
        return redirect()->route('dose.index')->with('successct', 'dose created successfully.');
    }

    public function edit(Dose $dose)
    {
        return view('pages.dose.edit',[
            'dose'    => $dose,
            'doses'    => Dose::all(),
        ]);
    }

    public function update(Request $request, Dose $dose)
    {
        $this->authorize('update', $dose);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $dose->name = $validatedData['name'];
        $dose->save();
        return redirect()->route('dose.index')->with('successup', 'dose updated successfully.');;
    }


    public function destroy(Dose $dose)
    {
        $this->authorize('delete', $dose);
        $dose->delete();
        return redirect()->route('dose.index')->with('successdt', 'dose deleted successfully.');;
    }
}
