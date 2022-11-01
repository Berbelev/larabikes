<?php

namespace App\Http\Controllers;

use App\Http\Requests\BikeDeleteRequest;
use App\Http\Requests\BikeRequest;
use App\Http\Requests\BikeUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Bike;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;


class BikeController extends Controller{

    /* ===========================================================
    |   CONSTRUCTOR
     *///=========================================================
    /**
     * MIDDLEWARE EN CONTROLADORES:
     *
     *  Pone un middleware a todos los métodos del controlador:
     *      $this->middleware('firefox');
     *
     *  Pone un middleware a todo excepto a index() y show():
     *      $this->middleware('adult')->except(['index','show']);
     *
     *  Pone middleware solamente a destroy()
     *      $this->middleware('throttle:3,1')->only('destroy');
     *
     * REGISTRO MIDDLEWARE EN CONTROLADOR:
     *  Pone un middleware a todos los métodos de controlador:
     *      $this->middleware(function(Request $request, $next){
     *          if($request->has('stop'))
     *              abort(503, 'La carga se ha interrumido');
     *           return $next($request);
     *      });
     *
     */
    public function __construct(){

        /**
        *   Para las operaciones con motos
        *   el usuario debe estar verificado
        *   excepto para :index(), show() y search()
        */
        $this->middleware('verified')->except(['index','show','search']);

        /**
         * El método para eliminar una moto requiere de confirmación de la clave
         */
        $this->middleware('password.confirm')->only('destroy');

    }




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
         *| Carga la vista para el listado
         *| la vista se llamará list.blade.php y se encontrará en la carpeta bikes
         *| a las vistas hay que pasarles los datos a modo de array asociativo
         */
    return View::make('bikes.list',['bikes'=>$bikes]);
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
     * 2.2_ store()
     * ---------------------------------------------------------
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\BikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BikeRequest $request){

        // _1_ RECUPERAR datos del formulario excepto la imagen
        $datos = $request->only(['marca','modelo', 'precio',
                                 'kms', 'matriculada', 'matricula',
                                  'color']);

        // _2_ NULL será el valor por defecto de la imagen
        $datos +=['imagen'=>NULL];

        // _3_ Recuperación de la imagen
        if($request->hasFile('imagen')){

            // _3.a_sube la imagen al directorio indicado en el fichero config
            $ruta=$request->file('imagen')->store(config('filesystems.bikesImageDir'));
            ;
            // _3.b_asignar a la imagen el nombre del fichero para ser guadado en la BDD
            $datos['imagen']= pathinfo($ruta, PATHINFO_BASENAME);
        }

        // recupera el id del usuario identificado y lo gruada en user_id de la moto
        $datos['user_id']= $request->user()->id;

        // _4_ Creción y guardado de la nueva moto
        $bike = Bike::create($datos);


        // _5_ redireccion a los detalles de la moto creada
        return redirect()
            ->route('bikes.show', $bike->id)
            ->with('success', "Moto $bike->marca $bike->modelo añadida con éxito.")
            ->cookie('lastInsertID', $bike->id,0);

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
    |   ACTUALIZACIÓN DE LA MOTO
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
    public function edit(Request $request, Bike $bike)    {

        // Autorización mediante policy
        if($request->user()->cant('delete',$bike))
            abort(401, 'No puedes actualizar esta moto');

        // carga la vista con el formulario para modificar la moto
        return view('bikes.update', ['bike'=>$bike]);
    }

    /** _________________________________________________________
     *
     * 4.2_ update()
     * ---------------------------------------------------------
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\BikeUpdateRequest  $request
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function update(BikeUpdateRequest $request, Bike $bike)   {

        // comporbar la validez de la firma de la URL
        if(!$request->hasValidSignature())
            abort(401, 'La firma de la URL ha caducado :(');

        // toma los datos del formulario
        $datos =$request->only('marca', 'modelo', 'kms', 'precio');

        // estos datos no se pueden tomar directamente
        $datos['matriculada'] = $request->has('matriculada')?1:0;
        $datos['matricula']= $request->has('matriculada')? $request->input('matricula'): NULL;
        $datos['color'] = $request->input('color') ?? NULL;

        // SI llega una nueva imágen...
        if($request->hasFile('imagen')){
            // ... SI IMAGEN,
            if($bike->imagen){
                // ... marcamos la imagen antigua para ser borrada ... si el update va bien...
                $aBorrar = config('filesystems.bikesImageDir').'/'.$bike->imagen;

            }
            // sube la imagen al directorio indicado en el fichero de confi
            $imagenNueva= $request->file('imagen')->store(config('filesystems.bikesImageDir'));

            // nos quedamos solo con el nombre del fichero para añadirlo a la BDD
            $datos['imagen']= pathinfo($imagenNueva, PATHINFO_BASENAME);
        }

        // SI el caso es que nos piden eliminar la imágen....
        if($request->filled('eliminarimagen') && $bike->imagen){
            // poner campo imagen a NULL
            $datos['imagen']=NULL;
            // recuperar el directorio para la imagen aBorrar
            $aBorrar= config('filesystems.bikesImageDir').'/'.$bike->imagen;
        }

        // SI todo va BIEN al actualizar
        if($bike->update($datos)){

            //...y SI la variable aBorrar tiene valor...
            if(isset($aBorrar))
                // Borra la foto antigua a través de la Facada Storage
                Storage::delete($aBorrar);

        // SIno , si FALLA algo....
        }else{
            // ...y SI la variable imgenNueva tiene valor
            if(isset($imagenNueva))
                // Borra la imagen nueva
                Storage::delete($imagenNueva);
        }

        // encola las cookies
        Cookie::queue('lastUpdateID', $bike->id,0);
        Cookie::queue('lastUpdateDate', now(),0);

        // carga la misma vista [return back()] y muestra mensaje de exito
        // muestra al user un mensaje de los cambios realizados con variable de session flaseada
        return back()
            ->with('success', "Moto $bike->marca $bike->modelo actualizada con éxito");


                /*FIXME:1 para que salga un bug ...
                |        evitar checkbox con matriculada en la vista
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
     * @param \Illuminate\Http\Request\BikeDeleteRequest $request
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function delete(BikeDeleteRequest $request, Bike $bike)    {

        // Realizamos la autorización mediante Policie en BikeDeleteRequest
        // FIXME:3_NO FUNCIONA POLICIE EN BIKEDELETEDREQUEST, CONTROLADOR METODO DELETE
        /**
          *  Autorización mediante policy, ejemplo:
          *     if($request->user()->cant('delete',$bike)).
          *          abort(401, 'No puedes borrar esta moto.');
          **/
          if($request->user()->cant('delete',$bike))
            abort(401, 'No puedes borrar esta moto.');
         /**
         * Autorización mediante gate,ejemplo:
         * Prueba para ver el funcionamiento de la gate.
         *  if(Gate::denies('borrarMoto',$bike))
         *      abort(401, 'No puedes borrar una moto que no es tuya');
         */

        //muestra formulario con mensaje de confirmaicón para el borrado de la moto
        // y recupera la moto para mostrar en la vista de blade
        return view('bikes.delete',['bike'=>$bike]);
    }
    /** _________________________________________________________
     *
     * destroy()
     * ---------------------------------------------------------
     * Elimina la moto confirmada definitivamente.
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bike $bike) {

        if($request->user()->cant('delete', $bike))
            abort(401, 'No puedes borrar una moto que no es tuya');


        // comporbar la validez de la firma de la URL
        if(!$request->hasValidSignature())
            abort(401, 'La firma de la URL no se pudo validar');



        // borra la moto de la base de datos y si tiene imagen...
        if($bike->delete() && $bike->imagen)
            // ... elimina la imagen
            Storage::delete(config('filesystems.bikesImageDir').'/'.$bike->imagen);


        // devuelve al usuario a la vista del listado de motos
        // muestra mensaje de exito de la operación con una variable de sesión flaseada
        return redirect('bikes')
            ->with('success', "Moto $bike->marca $bike->modelo eliminada");
    }
     /*
    |===========================================================
    |   BUSCAR MOTOS
    |   6.1_ search()
    |===========================================================
     */
    /** _________________________________________________________
     *
     * 6.1_ search()
     * ---------------------------------------------------------
     * Formulario para buscar motos a partir de marca y/o modelo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)    {

        // 6.1.1 valida lo que viene por request, max:16
        $request->validate(['marca'=>'max:16','modelo'=>'max:16']);

        // 6.1.2 Toma los valores de la Request
        $marca = $request->input('marca', '');
        $modelo = $request->input('modelo', '');

        /**
         * 6.1.3 Recupera los resultados de Bike where(campo,condición,valor)
         *      _Añade marca y modelo al paginador, para mantener los resultados
         */
        $bikes = Bike::where('marca','like','%'.$marca.'%')
                     ->where('modelo','like','%'.$modelo.'%')
                     ->paginate(config('pagination.bikes'))
                     ->appends(['marca'=>$marca, 'modelo'=>$modelo]);

        // 6.1.4 Retorna la vista con el filtro aplicado
        return view('bikes.list',['bikes'=>$bikes, 'marca'=>$marca,'modelo'=>$modelo]);
    }

         /*
    |===========================================================
    |
    |   7.1_ editLast()
    |===========================================================
     */
    /** _________________________________________________________
     *
     * 7.1_ editLast()
     * ---------------------------------------------------------
     *
     * Edita la última moto creada (para ver funcionamiento cookies)
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editLast(){
        // comprobar si llega la cookie 'lastInsertId' con el ID de la
        // última moto que fué creada por el usuario

        // si no llega, lo llevamos al formulario de creación nueva moto
        if(!Cookie::has('lastInsertID'))
            return redirect()->route('bikes.create');

        // si llega, recuperamos el dato de la cookie(el id)
        // y lo llevamos a la vista de edición de la moto
        $id = Cookie::get('lastInsertID');
        return redirect()->route('bikes.edit', $id);
    }
}
