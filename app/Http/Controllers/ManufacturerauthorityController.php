<?php

namespace App\Http\Controllers;

use App\Models\Manufacturerauthority;
use Illuminate\Http\Request;

class ManufacturerauthorityController extends Controller
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
        return view('pages.manufacturerauthority.index',[
            'manufacturerauthorities'    => Manufacturerauthority::all(),
        ]);
    }

    public function create(Manufacturerauthority $manufacturerauthority)
    {
        $this->authorize('create', $manufacturerauthority);
        return view('pages.manufacturerauthority.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $manufacturerauthority = new Manufacturerauthority;
        $manufacturerauthority->name = $validatedData['name'];
        $manufacturerauthority->author_id = auth()->user()->id;
        $manufacturerauthority->save();
        return redirect()->route('manufacturer-authority.index')->with('successct', 'manufacturerauthority created successfully.');
    }

    public function edit(Manufacturerauthority $manufacturerauthority)
    {
        return view('pages.manufacturerauthority.edit', compact('manufacturerauthority'));
    }

    public function update(Request $request, Manufacturerauthority $manufacturerauthority)
    {
        $this->authorize('update', $manufacturerauthority);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $manufacturerauthority->name = $validatedData['name'];
        $manufacturerauthority->save();
        return redirect()->route('manufacturer-authority.index')->with('successup', 'manufacturerauthority updated successfully.');;
    }


    public function destroy(Manufacturerauthority $manufacturerauthority)
    {
        $this->authorize('delete', $manufacturerauthority);
        $manufacturerauthority->delete();
        return redirect()->route('manufacturer-authority.index')->with('successdt', 'manufacturerauthority deleted successfully.');;
    }
}
