<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
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
        return view('pages.ingredient.index',[
            'ingredients'    => Ingredient::all(),
        ]);
    }

    public function create(Ingredient $ingredient)
    {
        $this->authorize('create', $ingredient);
        return view('pages.ingredient.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $ingredient = new Ingredient;
        $ingredient->name = $validatedData['name'];
        $ingredient->author_id = auth()->user()->id;
        $ingredient->save();
        return redirect()->route('ingredient.index')->with('successct', 'Ingredient created successfully.');
    }

    public function edit(Ingredient $ingredient)
    {
        return view('pages.ingredient.edit', compact('ingredient'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $this->authorize('update', $ingredient);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $ingredient->name = $validatedData['name'];
        $ingredient->save();
        return redirect()->route('ingredient.index')->with('successup', 'Ingredient updated successfully.');;
    }


    public function destroy(Ingredient $ingredient)
    {
        $this->authorize('delete', $ingredient);
        $ingredient->delete();
        return redirect()->route('ingredient.index')->with('successdt', 'Ingredient deleted successfully.');;
    }
}
