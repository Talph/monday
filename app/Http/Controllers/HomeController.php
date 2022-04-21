<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use App\Models\Time;

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
        $timings = Board::all();
        return view('home', ["timings" => $timings]);
    }
    public function show()
    {
        $timings = Board::all();
        return view('board', ["timings" => $timings]);
    }
}
