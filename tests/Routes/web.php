

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
