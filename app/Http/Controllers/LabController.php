<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Lab;
use Illuminate\Http\Request;

class LabController extends Controller
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
        return view('pages.lab.index',[
            'labs'    => Lab::all(),
        ]);
    }

    public function create(Lab $lab)
    {
        $this->authorize('create', $lab);
        return view('pages.lab.create',[
            'countries'    => Country::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $lab = new Lab;
        $lab->name = $validatedData['name'];
        $lab->recognized_agency = $request->recognized_agency;
        $lab->website = $request->website;
        $lab->country_id = $request->country_id;
        $lab->author_id = auth()->user()->id;
        $lab->save();
        return redirect()->route('lab.index')->with('successct', 'Lab created successfully.');
    }

    public function edit(Lab $lab)
    {
        $this->authorize('update', $lab);
        $selectedCountry = $lab->country;
        return view('pages.lab.edit',[
            'lab'            => $lab,
            'countries'        => Country::all(),
            'selectedCountry'  => $selectedCountry,
        ]);
    }

    public function update(Request $request, Lab $lab)
    {
        $this->authorize('update', $lab);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $lab->name = $validatedData['name'];
        $lab->recognized_agency = $request->recognized_agency;
        $lab->website = $request->website;
        $lab->country_id = $request->country_id;
        $lab->save();
        return redirect()->route('lab.index')->with('successup', 'Lab updated successfully.');;
    }


    public function destroy(Lab $lab)
    {
        $this->authorize('delete', $lab);
        $lab->delete();
        return redirect()->route('lab.index')->with('successdt', 'Lab deleted successfully.');;
    }
}
