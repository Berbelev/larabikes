<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

class BikeDeleteRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()    {
        return $this->user()->can('delete', $this->bike);
        //FIXME:3_NO FUNCIONA POLICIE EN BIKEDELETEDREQUEST, CONTROLADOR METODO DELETE
    }

    /**
     * Mensaje en caso que falle la autorización
     *
     * @return Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthorization()    {
        return new AuthorizationException('No puedes eliminar una moto que no es tuya.');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()    {
        return [
            //
        ];
    }
}
