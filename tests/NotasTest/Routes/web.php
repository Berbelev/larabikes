

/*
|==========================================================================
|  ZONA PARA PRUEBAS
|==========================================================================
*/

Route::get('saludar',function(){
    return 'Hola Mundo! :D';
});

======================================================================
_TEST_____________________________________

Route::get('test',function(){
    return 'Estás haciendo la prueba por GET';
});

Route::post('test',function(){
    return 'Estás haciendo la prueba por POST ';
});

Route::put('test',function(){
    return 'Estás haciendo la prueba por PUT';
});

Route::delete('test',function(){
    return 'Estás haciendo la prueba por DELETE';
});
_____________________________________________________________________



====================================================================
_PROBANDO EL MÉTODO match()_________________________________________

Route::match(['PUT', 'DELETE']), 'test', function(Request $request){
    return 'Estás haciendo la prueba por'.$request->getMethod();
});

#POSTMAN
    #PUT
        http://localhost:8000/test  // 200 OK
    #PATCH
        http://localhost:8000/test  // 405 Method Not Allowed
_____________________________________________________________________



====================================================================
_PROBANDO EL MÉTODO any()_________________________________________

Route::any('test', function(Request $request){
    return 'Estás haciendo la prueba por'.$request->getMethod();
});

#POSTMAN
    #PATCH
        http://localhost:8000/test  // 200 OK
_____________________________________________________________________



====================================================================
_REDIRECCION DE RUTAS_______________________________________________

Route::redirect('test', 'bikes', 301);

#POSTMAN
    #GET
        http://localhost:8000/test  // 200 OK
    #GET (configurado a no automático)
        http://localhost:8000/test  // 301 Method Permanently
_____________________________________________________________________

====================================================================
_CARGAR RUTAS DESDE EL FICHERO DE RUTAS_______________________________________________

Route::view('test', 'welcome');

#POSTMAN
    #GET
        http://localhost:8000/test  // 200 OK

_____________________________________________________________________
/*

|==========================================================================
|  RUTA DE FALLBACK (debe ser la ultima en el fichero)
|==========================================================================
*/
Route::fallback([WelcomeController::class, 'index']);

#POSTMAN
    #GET
        http://localhost:8000/patata  // 200 OK


|==========================================================================
|   PARAMETROS EN LA RUTA
|==========================================================================
*/
 // ruta con dos parámetros variables
Route::get('test/{nombre}/{edad}', function($nombre, $edad){
    return "Hola $nombre, tienes $edad años.";
});
// ruta con 1 parámetro
Route::get('test/{nombre}', function($nombre){
    return "Hola $nombre, bienvenido al curso.";
});


/*
|==========================================================================
|  SOLAPAMIENTO DE RUTAS
|==========================================================================
*/
//
Route::get('test/{id}', function($id){
    return "Intentas visualizar la moto $id.";
});
//
Route::get('test/create', function(){
    return "Intentas visualizar una nueva moto.";
});

/*
|==========================================================================
|  SOLUCIÓN AL SOLAPAMIENTO DE RUTAS
|==========================================================================
*/
//
Route::get('test/create', function(){
    return "Intentas visualizar una nueva moto.";
});
//
Route::get('test/{id}', function($id){
    return "Intentas visualizar la moto $id.";
});

/*
|==========================================================================
|  RUTA CON PARAMETROS OPCIONALES (SEARCH)
|==========================================================================
*/
use App\Models\Bike;

// ruta con dos parámetros opcionales
Route::get(
    'bikes/search/{marca?}/{modelo?}',
    function($marca ='', $modelo=''){
        // busca las motos con esa marca y modelo
        $bikes=Bike::where('marca', 'like', '%'.$marca.'%')
                   ->where('modelo', 'like','%'.$modelo.'%')
                   ->paginate(config('pagination.bikes'));

    return view('bikes.list', ['bikes'=>$bikes]);
    }
);
//

/*
|==========================================================================
|  EXPRESIONES REGULARES EN LA RUTAS
|==========================================================================
*/
//
Route::get('test/{id}', function($id){
    return "Has accedido por la primera ruta.";
})->where('id', '^\d{1,11}$'); // de 1 a 11 dígitos
//
Route::get('test/{dni}', function($dni){
    return "Has accedido por la segunda ruta.";
})->where('dni', '^[\dXYZ]\d{7}[A-Z]$'); // DNI
//
Route::get('test/{otro}', function($otro){
    return "$otro no es un número ni un DNI.";
});

/*
|==========================================================================
|  INFORMACIÓN SOBRE LA RUTA
|==========================================================================
*/
//Route::current()  --->retorna un objeto Route
Route::get('test', function(){

    dd(Route::current());

    return "Aquí no vamos a llegar, porque hay un dd() antes.";
});

//
Route::get('test', function(){

    dd(Route::currentRouteName());

    return "Aquí no vamos a llegar, porque hay un dd() antes.";
});

//
Route::get('test', function(){

    dd(Route::currentRouteAction());

    return "Aquí no vamos a llegar, porque hay un dd() antes.";
});
