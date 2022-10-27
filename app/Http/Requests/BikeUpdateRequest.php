<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BikeRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Policies\BikePolicy;

class BikeUpdateRequest extends BikeRequest{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()    {
        // Retrona true solament si el usuario tiene permiso para actualizar
        return $this->user()->can('update', $this->bike);
    }

    /**
     * Mensaje en caso de que falle la autorización
     *
     * @return Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthotization()    {
        // Retrona true solament si el usuario tiene permiso para actualizar
        return new AuthorizationException('No puedes editar una moto que no es tuya.');
        // FIXME:4 NO APARECE EL MENSAJE DE LA EXCEPCIÓN, SOLO ERROR 403
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()    {
        /**
         * Con implicit binding se mapea automáticamente la instancia del modelo
         * a modo de propiedad de la request
         */
         $id = $this->bike->id;


        //retorna la rega de la matrícula modificada y las regas del padre.
        return [
            'matricula'=>"required_if:matriculada, 1|
                          nullable|
                          regex:/^\d{4}[B-Z]{3}$/i|
                          unique:bikes,matricula, $id"
        ]+parent::rules();
    }
}
