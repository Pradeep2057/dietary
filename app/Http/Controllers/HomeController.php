<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fiscalyear;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.dashboard.index', [
            'fiscalyears'    => Fiscalyear::all(),
        ]);
    }
    public function profile()
    {
        return view('pages.dashboard.profile');
    }
}
