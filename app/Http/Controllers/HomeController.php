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

        // recuperar las motos NO borradas del usuario
        $bikes = $request->user()->bikes()
                ->paginate(config('pagination.bikes', 10));

        // recuperar las motos borradas del usuario
        $deleteBikes = $request->user()->bikes()->onlyTrashed()->get();

        return view('home', ['bikes'=>$bikes, 'deleteBikes'=>$deleteBikes]);
    }
}
