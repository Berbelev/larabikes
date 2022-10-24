<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BikeRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()    {
        return true; // cambiamos a true provisionalmente para que funcione el form request
                     // hasta que implementemos los gates o policies para autorización de usuario
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     *
     *  REGLAS PERSONALIZADAS:
     *  'marca'       => ['required','max:255', new \App\Rules\Mayusculas()],
     *  'modelo'      => ['required','max:255', function($name, $value, $fail){
     *      if($value != strtolower($value))
     *          $fail("El campo $name debe estar en minúsculas");
     *  }],
     *
     */
    public function rules()    {
        return [
            'marca'       => 'required|max:255',
            'modelo'      => 'required|max:255',
            'precio'      => 'required|numeric|min:0',
            'kms'         => 'required|integer|min:0',
            'matriculada' => 'required_with:matricula',
            'matricula'   => 'required_if:matriculada, 1|
                              nullable|
                              regex:/^\d{4}[B-Z]{3}$/i|
                              unique:bikes|
                              confirmed',
            'color'       => 'nullable|
                              regex:/^#[\dA-F]{6}$/i',
            'imagen'      => 'sometimes|
                              file|
                              image|
                              mimes:jpg,png,gif,webp|
                              max:2048'


        ];
    }

    /**
     * Return the messages
     */
    public function messages(){
        return [
            'precio.numeric'=>'El precio debe ser un número.',
            'precio.min'=>'El precio debe ser mayor o igual a cero.',
            'kms.numeric'=>'Los kilómetros deben ser un número.',
            'Kms.min'=>'Los kilometros deben ser 0 o más.',
            'matricula.required'=>'La matrícula es obligatoria si la moto está matriculada.',
            'matricula.unique'=>'Ya existe una moto con la misma matrícula.',
            'matricula.regex'=>'La matrícula debe contener cuatro dígitos y tres letras.',
            'matricula.confirmed'=>'La confirmación de matrícula no coincide',
            'color.regex'=>'El color debe estar en formato RGB HEX comenzando por #.',
            'imagen.image'=>'El fichero debe ser una imagen',
            'imagen.mines'=>'La imagen debe ser de tipo jpg, png, gif o webp.',

        ];
    }
}
