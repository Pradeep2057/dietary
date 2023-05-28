<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Imports\CategoryImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{

    public function index()
    {
        return view('pages.category.import');
    }

    public function importCategory(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new CategoryImport, $file);

        return redirect()->back()->with('success', 'Category imported successfully.');
    }
}
