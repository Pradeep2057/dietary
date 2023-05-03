<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        return view('pages.category.index',[
            'categories'    => Category::all(),
        ]);
    }

    public function create(Category $category)
    {
        $this->authorize('create', $category);
        return view('pages.category.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $category = new Category;
        $category->name = $validatedData['name'];
        $category->remarks = $request->remarks;
        $category->author_id = auth()->user()->id;
        $category->save();
        return redirect()->route('category.index')->with('successct', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('pages.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $category->name = $validatedData['name'];
        $category->remarks = $request->remarks;
        $category->save();
        return redirect()->route('category.index')->with('successup', 'Category updated successfully.');;
    }


    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        $category->delete();
        return redirect()->route('category.index')->with('successdt', 'Category deleted successfully.');;
    }
}

