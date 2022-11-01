HELPERS
===================================================================
helper url()
===================================================================
url()
    * Retorna una instancia de Illuminate\Routing\UrlGenerator
        -Permite acceder a información sobre la URL array_count_values


    ⚫ url()->current() → recupera la URL sin la query string.
    ⚫ url()->full() → recupera la URL con la query string.
    ⚫ url()->previous() → recupera la URL de la petición anterior.

    Se puede acceder a estos métodos mediante la fachada URL:

    ⚫ URL::current()

===================================================================
helper route()
===================================================================
Se pueden pasar parámetrós de varias formas :

    1 parámetro: directamente
    2 o +      : a modo array asociativo

route()
    * genera una ruta absoluta

        {{route('bikes.show','$bike->id')}}

    * Para generar una ruta absoluta:
        - Hay que pasar un tercer parámetro con el valore 'false'

        {{route('bikes.show',['bike'=>$bike->id])}}


===================================================================
helper asset()
===================================================================
Se utiliza para la inclusión de ficheros externos en las vistas
(imágenes, CSS, scripts...).

{{asset('img/button/show.png')}}

===================================================================
helper action()
===================================================================
