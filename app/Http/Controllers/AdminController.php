<?php

namespace App\Http\Controllers;

use App\Models\Bike;

use Illuminate\Http\Request;

class AdminController extends Controller{

    public function deletedBikes(){

        // recupera las motos borradas
        $bikes = Bike::onlyTrashed()
            ->paginate(config('pagination.bikes',10));

        // carga la vista
        return view('admin.bikes.deleted', ['bikes'=>$bikes]);
    }
}
