<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Manufacturerauthority;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
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
        return view('pages.manufacturer.index',[
            'manufacturers'    => Manufacturer::all(),
        ]);
    }

    public function create(Manufacturer $manufacturer)
    {
        $this->authorize('create', $manufacturer);
        return view('pages.manufacturer.create',[
            'countries'    => Country::all(),
            'manufacturerauthorities'    => Manufacturerauthority::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $manufacturer = new Manufacturer;
        $manufacturer->name = $validatedData['name'];
        $manufacturer->registration_number = $request->registration_number;
        $manufacturer->registration_authority = $request->registration_authority;
        $manufacturer->registration_validity = $request->registration_validity;
        $manufacturer->country_id = $request->country_id;
        $manufacturer->author_id = auth()->user()->id;
        $manufacturer->save();
        return redirect()->route('manufacturer.index')->with('successct', 'manufacturer created successfully.');
    }

    public function edit(Manufacturer $manufacturer)
    {
        $this->authorize('update', $manufacturer);
        $selectedCountry = $manufacturer->country;
        $selectedManufacturerauthority = $manufacturer->manufacturerauthority;
        return view('pages.manufacturer.edit',[
            'manufacturer'            => $manufacturer,
            'countries'        => Country::all(),
            'manufacturerauthorities'    => Manufacturerauthority::all(),
            'selectedCountry'  => $selectedCountry,
            'selectedManufacturerauthority'  => $selectedManufacturerauthority,
        ]);
    }

    public function update(Request $request, Manufacturer $manufacturer)
    {
        $this->authorize('update', $manufacturer);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $manufacturer->name = $validatedData['name'];
        $manufacturer->registration_number = $request->registration_number;
        $manufacturer->registration_authority = $request->registration_authority;
        $manufacturer->registration_validity = $request->registration_validity;
        $manufacturer->country_id = $request->country_id;
        $manufacturer->save();
        return redirect()->route('manufacturer.index')->with('successup', 'manufacturer updated successfully.');;
    }


    public function destroy(Manufacturer $manufacturer)
    {
        $this->authorize('delete', $manufacturer);
        $manufacturer->delete();
        return redirect()->route('manufacturer.index')->with('successdt', 'manufacturer deleted successfully.');;
    }
}
