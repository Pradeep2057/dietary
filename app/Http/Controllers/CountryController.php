<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
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
        return view('pages.country.index',[
            'countries'    => Country::all(),
        ]);
    }

    public function create(Country $country)
    {
        $this->authorize('create', $country);
        return view('pages.country.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'population' => 'required',
            'area' => 'required',
        ]);
        $country = new Country;
        $country->name = $validatedData['name'];
        $country->population = $request->population;
        $country->area = $request->area;
        $country->author_id = auth()->user()->id;
        $country->save();
        return redirect()->route('country.index')->with('successct', 'Country created successfully.');
    }

    public function edit(Country $country)
    {
        return view('pages.country.edit',[
            'country'    => $country,
            'countries'    => Country::all(),
        ]);
    }

    public function update(Request $request, Country $country)
    {
        $this->authorize('update', $country);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'population' => 'required',
            'area' => 'required',
        ]);
        $country->name = $validatedData['name'];
        $country->population = $request->population;
        $country->area = $request->area;
        $country->save();
        return redirect()->route('country.index')->with('successup', 'Country updated successfully.');;
    }


    public function destroy(Country $country)
    {
        $this->authorize('delete', $country);
        $country->delete();
        return redirect()->route('country.index')->with('successdt', 'Country deleted successfully.');;
    }
}
