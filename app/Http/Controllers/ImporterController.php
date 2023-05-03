<?php

namespace App\Http\Controllers;

use App\Models\Importer;
use Illuminate\Http\Request;

class ImporterController extends Controller
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
        return view('pages.importer.index',[
            'importers'    => Importer::all(),
        ]);
    }

    public function create(Importer $importer)
    {
        $this->authorize('create', $importer);
        return view('pages.importer.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $importer = new Importer;
        $importer->name = $validatedData['name'];
        $importer->address = $request->address;
        $importer->pan = $request->pan;
        $importer->firm_no = $request->firm_no;
        $importer->exim_code = $request->exim_code;
        $importer->contact_number = $request->contact_number;
        $importer->contact_person = $request->contact_person;
        $importer->author_id = auth()->user()->id;
        $importer->save();
        return redirect()->route('importer.index')->with('successct', 'Importer created successfully.');
    }

    public function edit(Importer $importer)
    {
        return view('pages.importer.edit', compact('importer'));
    }

    public function update(Request $request, Importer $importer)
    {
        $this->authorize('update', $importer);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $importer->name = $validatedData['name'];
        $importer->address = $request->address;
        $importer->pan = $request->pan;
        $importer->firm_no = $request->firm_no;
        $importer->exim_code = $request->exim_code;
        $importer->contact_number = $request->contact_number;
        $importer->contact_person = $request->contact_person;
        $importer->save();
        return redirect()->route('importer.index')->with('successup', 'Importer updated successfully.');;
    }


    public function destroy(Importer $importer)
    {
        $this->authorize('delete', $importer);
        $importer->delete();
        return redirect()->route('importer.index')->with('successdt', 'Importer deleted successfully.');;
    }
}
