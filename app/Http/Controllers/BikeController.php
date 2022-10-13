<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;

class BikeController extends Controller{


    /*
    |===========================================================
    |   LISTA DE MOTOS
    |   1. index() 
    |===========================================================
     */
    /**
     * _________________________________________________________
     * 
     * index()
     * --------------------------------------------------------- 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        /**
        * Recupera las motos de la BDD usando el modelo
        * Ordenado por id descendente y
        * Paginación de 10 resultados por pagina
        */
        $bikes= Bike::orderBy('id','DESC')
            ->paginate(config('pagination.bikes', 10));

        // total de motos en la BDD (para mostrar)
        $total = Bike::count();

        /**
         * Carga la vista para el listado
         * la vista se llamará list.blade.php y se encontrará en la carpeta bikes
         * a las vistas hay que pasarles los datos a modo de array asociativo
         */
        return view('bikes.list',['bikes'=>$bikes, 'total'=>$total]);
    }



    /*
    |===========================================================
    |   GUARDAR MOTO
    |   2.1_ create() y 2.2_ store()
    |===========================================================
     */
    /**
     * _________________________________________________________
     * 
     * create()
     * ---------------------------------------------------------      
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        // Carga la vista con el formulario
        
    }

    /**
    * _________________________________________________________
     * 
     * store()
     * ---------------------------------------------------------
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
    }

    /**
     * _________________________________________________________
     * 
     * show(int $id)
     * ---------------------------------------------------------
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * _________________________________________________________
     * 
     * edit()
     * ---------------------------------------------------------
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * _________________________________________________________
     * 
     * update()
     * --------------------------------------------------------- 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * _________________________________________________________
     * 
     * destroy()
     * ---------------------------------------------------------
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
