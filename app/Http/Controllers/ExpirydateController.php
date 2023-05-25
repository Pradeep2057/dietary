<?php

namespace App\Http\Controllers;

use App\Models\Expirydate;
use Illuminate\Http\Request;

class ExpirydateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('pages.expirydate.index',[
            'expirydates'    => Expirydate::all(),
        ]);
    }

    public function create(Expirydate $expirydate)
    {
        $this->authorize('create', $expirydate);
        return view('pages.expirydate.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $expirydate = new Expirydate;
        $expirydate->name = $validatedData['name'];
        $expirydate->author_id = auth()->user()->id;
        $expirydate->save();
        return redirect()->route('expirydate.index')->with('successct', 'Expirydate created successfully.');
    }

    public function edit(Expirydate $expirydate)
    {
        return view('pages.expirydate.edit',[
            'expirydate'    => $expirydate,
            'expirydates'    => Expirydate::all(),
        ]);
    }

    public function update(Request $request, Expirydate $expirydate)
    {
        $this->authorize('update', $expirydate);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $expirydate->name = $validatedData['name'];
        $expirydate->save();
        return redirect()->route('expirydate.index')->with('successup', 'expirydate updated successfully.');;
    }


    public function destroy(Expirydate $expirydate)
    {
        $this->authorize('delete', $expirydate);
        $expirydate->delete();
        return redirect()->route('expirydate.index')->with('successdt', 'expirydate deleted successfully.');;
    }
}
