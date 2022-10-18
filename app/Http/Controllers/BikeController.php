<?php

namespace App\Http\Controllers;

use App\Http\Requests\BikeRequest;
use App\Http\Requests\BikeUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Bike;
use Illuminate\Support\Facades\View;

class BikeController extends Controller{


    /*
    |===========================================================
    |   LISTA DE MOTOS
    |   1. index()
    |===========================================================
     */
    /** _________________________________________________________
     *
     * index()
     * ---------------------------------------------------------
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        /**
        *| Recupera las motos de la BDD usando el modelo
        *| Ordenado por id descendente y
        *| Paginación de 10 resultados por pagina
        */
        $bikes= Bike::orderBy('id','DESC')
            ->paginate(config('pagination.bikes', 10));

        /**
         *| total de motos en la BDD (para mostrar)
         */
        $total = Bike::count();// <FIXME:1 class="1">1.1</FIXME:1>lo traslado a ViewComposer

        /**
         *| Carga la vista para el listado
         *| la vista se llamará list.blade.php y se encontrará en la carpeta bikes
         *| a las vistas hay que pasarles los datos a modo de array asociativo
         */
    return View::make('bikes.list',['bikes'=>$bikes ,'total'=>$total]);
    }



    /*
    |===========================================================
    |   GUARDAR MOTO
    |   2.1_ create() y 2.2_ store()
    |===========================================================
     */
    /** _________________________________________________________
     *
     * 2.1_ create()
     * ---------------------------------------------------------
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        // Carga la vista con el formulario
        return view('bikes.create');

    }

    /** _________________________________________________________
     *
     * 2.2_ store() <FIXME:2 class="2">2.4 validacion</FIXME:2>
     * ---------------------------------------------------------
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\BikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BikeRequest $request){

        // Recuperar datos del formulario excepto la imagen
        $datos = $request->only(['marca','modelo', 'precio',
                                 'kms', 'matriculada', 'matricula',
                                  'color']);

        // creación y guardado de la nueva moto
        $bike = Bike::create($datos);


        // redirecciona a los detalles de la moto creada
        return redirect()
            ->route('bikes.show', $bike->id)
            ->with('success', "Moto $bike->marca $bike->modelo añadida con éxito.");

    }

    /*
    |===========================================================
    |   DETALLES DE LA MOTO
    |   3. show()
    |===========================================================
     */
    /** _________________________________________________________
     *
     * 3. show()
     * ---------------------------------------------------------
     * Display the specified resource.
     *
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function show(Bike $bike) {

        //carga la vista correspondiente
        // y le pasa la moto
        return view('bikes.show', ['bike'=>$bike]);
    }

    /*
    |===========================================================
    |   DETALLES DE LA MOTO
    |   4.1_ edit() y 4.2_update()
    |===========================================================
     */
    /** _________________________________________________________
     *
     * 4.1_ edit()
     * ---------------------------------------------------------
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function edit(Bike $bike)    {

        // carga la vista con el formulario para modificar la moto
        return view('bikes.update', ['bike'=>$bike]);
    }

    /** _________________________________________________________
     *
     * 4.2_ update() // <FIXME:2 class="2">2.5 validacion</FIXME:2>
     * ---------------------------------------------------------
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\BikeUpdateRequest  $request
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function update(BikeUpdateRequest $request, Bike $bike)   {

        // toma los datos del formulario
        $datos =$request->only('marca', 'modelo', 'kms', 'precio');

        // estos datos no se pueden tomar directamente
        $datos['matriculada'] = $request->has('matriculada')?1:0;
        $datos['matricula']= $request->has('matriculada')? $request->input('matricula'): NULL;
        $datos['color'] = $request->input('color') ?? NULL;


        // actualiza los cambios de moto en la base de datos
        $bike->update($datos);


        // TODO: encola las cookies
        // Cookie::queue('lastUpdateID', $bike->id,0);
        // Cookie::queue('lastUpdateDate', now(),0);

        // carga la misma vista [return back()] y muestra mensaje de exito
        // muestra al user un mensaje de los cambios realizados con variable de session flaseada
        // anexar cookies con el último ID
        return back()
            ->with('success', "Moto $bike->marca $bike->modelo actualizada con éxito")
            // ->cookie('lastUpdateID', $bike->id,0)
            ;

                /*FIXME: para que no nos salga un saltamontes o cucharacha...
                |        evitar utilizar checkbox con matriculada en la vista
                |        al desmarcarlo, Eloquente no realiza la modificación en la BDD
                |
                |       SOLUCIÓN: usar desplegables o botones de radio para matriculada
                |                 en la vista 'bikes.update'
                */
    }



    /*
    |===========================================================
    |   ELIMINAR MOTO
    |   5.1_ delete() y 5.2_destroy()
    |===========================================================
     */
    /** _________________________________________________________
     *
     * 5.1_ delete()
     * ---------------------------------------------------------
     * Muestra el formulario de confirmación
     *
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function delete(Bike $bike)    {
        //muestra formulario con mensaje de confirmaicón para el borrado de la moto
        // y recupera la moto para mostrar en la vista de blade
        return view('bikes.delete',['bike'=>$bike]);
    }
    /** _________________________________________________________
     *
     * destroy()
     * ---------------------------------------------------------
     * Elimina la moto confirmada definitivamente.
     *
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bike $bike) {


        // borra la moto de la base de datos
        $bike->delete();

        // devuelve al usuario a la vista del listado de motos
        // muestra mensaje de exito de la operación con una variable de sesión flaseada
        return redirect('bikes')
            ->with('success', "Moto $bike->marca $bike->modelo eliminada");
    }
}
