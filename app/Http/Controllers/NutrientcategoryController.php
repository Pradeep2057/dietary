<?php

namespace App\Http\Controllers;

use App\Models\Nutrientcategory;
use Illuminate\Http\Request;

class NutrientcategoryController extends Controller
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
        return view('pages.nutrientcategory.index',[
            'nutrientcategories'    => Nutrientcategory::all(),
        ]);
    }

    public function create(Nutrientcategory $nutrientcategory)
    {
        $this->authorize('create', $nutrientcategory);
        return view('pages.nutrientcategory.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $nutrientcategory = new Nutrientcategory;
        $nutrientcategory->name = $validatedData['name'];
        $nutrientcategory->author_id = auth()->user()->id;
        $nutrientcategory->save();
        return redirect()->route('nutrient-category.index')->with('successct', 'Nutrient category created successfully.');
    }

    public function edit(Nutrientcategory $nutrientcategory)
    {
        return view('pages.nutrientcategory.edit', compact('nutrientcategory'));
    }

    public function update(Request $request, Nutrientcategory $nutrientcategory)
    {
        $this->authorize('update', $nutrientcategory);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $nutrientcategory->name = $validatedData['name'];
        $nutrientcategory->save();
        return redirect()->route('nutrient-category.index')->with('successup', 'Nutrient category updated successfully.');;
    }


    public function destroy(Nutrientcategory $nutrientcategory)
    {
        $this->authorize('delete', $nutrientcategory);
        $nutrientcategory->delete();
        return redirect()->route('nutrient-category.index')->with('successdt', 'Nutrient category deleted successfully.');;
    }
}
