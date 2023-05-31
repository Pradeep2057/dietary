<?php

namespace App\Http\Controllers;

use App\Models\Nutrientcategory;
use App\Models\Nutrients;
use Illuminate\Http\Request;

class NutrientController extends Controller
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
        return view('pages.nutrient.index',[
            'nutrients'    => Nutrients::all(),
        ]);
    }

    public function create(Nutrients $nutrients)
    {
        $this->authorize('create', $nutrients);
        return view('pages.nutrient.create',[
            'nutrientcategories'    => Nutrientcategory::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'common_name'=>'required',
            'rda'=>'required',
            'minimum'=>'required',
        ]);
        $nutrients = new Nutrients;
        $nutrients->name = $validatedData['name'];
        $nutrients->common_name = $request->common_name;
        $nutrients->unit_of_expression = $request->unit_of_expression;
        $nutrients->rda = $request->rda;
        $nutrients->minimum = $request->minimum;
        $nutrients->permissable_unit = $request->permissable_unit;
        $nutrients->permissable_overage = $request->permissable_overage;
        $nutrients->caution = $request->caution;
        $nutrients->usable_part = $request->usable_part;
        $nutrients->nutrient_category = $request->nutrient_category;
        $nutrients->author_id = auth()->user()->id;
        $nutrients->save();
        return redirect()->route('nutrient.index')->with('successct', 'nutrient created successfully.');
    }

    public function edit(Nutrients $nutrients)
    {
        $this->authorize('update', $nutrients);
        $selectedNutrientcategory = $nutrients->nutrientcategory;
        return view('pages.nutrient.edit',[
            'nutrients'            => $nutrients,
            'nutrientcategories'    => Nutrientcategory::all(),
            'selectedNutrientcategory'  => $selectedNutrientcategory,
        ]);
    }

    public function update(Request $request, Nutrients $nutrients)
    {
        $this->authorize('update', $nutrients);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'common_name'=>'required',
            'rda'=>'required',
            'minimum'=>'required',
        ]);
        $nutrients->name = $validatedData['name'];
        $nutrients->common_name = $request->common_name;
        $nutrients->unit_of_expression = $request->unit_of_expression;
        $nutrients->rda = $request->rda;
        $nutrients->minimum = $request->minimum;
        $nutrients->permissable_unit = $request->permissable_unit;
        $nutrients->permissable_overage = $request->permissable_overage;
        $nutrients->caution = $request->caution;
        $nutrients->usable_part = $request->usable_part;
        $nutrients->nutrient_category = $request->nutrient_category;
        $nutrients->save();
        return redirect()->route('nutrient.index')->with('successup', 'nutrients updated successfully.');;
    }


    public function destroy(Nutrients $nutrients)
    {
        $this->authorize('delete', $nutrients);
        $nutrients->delete();
        return redirect()->route('nutrient.index')->with('successdt', 'nutrients deleted successfully.');;
    }
}
