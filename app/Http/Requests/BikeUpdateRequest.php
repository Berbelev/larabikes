<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BikeUpdateRequest extends BikeRequest{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()    {
        /**
         * Con implicit binding se mapea automáticamente la instancia del modelo
         * a modo de propiedad de la request
         * $id = $this->bike>id;
         */


        /**
         * Tambén se pued recuperar así:
         */
        $id = $this->route('bike');


        //retorna la rega de la matrícula modificada y las regas del padre.
        return [
            'matricula'=>"required_if:matriculada, true|
                          nullable|
                          regex:/^\d{4}[B-Z]{3}$/i|
                          unique:bikes, matricula, $id"
        ]+parent::rules();
    }
}
