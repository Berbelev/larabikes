<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Bike;


class BikeComposer{
    /**
     * Vincula la información a la vista
     *
     * @param View $view
     *
     *
     */
    public function composer(View $view)    {

        // <FIXME:1 class="1">1.2</FIXME:1>     $view->with('total', Bike::count());
    }


}
