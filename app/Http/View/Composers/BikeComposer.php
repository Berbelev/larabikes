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
    public function compose(View $view)    {

        $view->with('total', Bike::count());
    }


}
