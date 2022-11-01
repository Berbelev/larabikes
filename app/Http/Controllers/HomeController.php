<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request){

        // recuperar las motos del usuario
        $bikes = $request->user()->bikes()
                ->paginate(config('pagination.bikes', 10));

        return view('home', ['bikes'=>$bikes]);
    }
}
