<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIniciadorRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre'            => 'required|regex:/^[A-ZÁÀÂÇÉÈÊËÍÎÏÓÔÚÛÙÜŸÑÆŒa-záàâçéèêëíîïóôúûùüÿñæœ ]+$/|max:255',
            'apellido'          => 'regex:/^[A-ZÁÀÂÇÉÈÊËÍÎÏÓÔÚÛÙÜŸÑÆŒa-záàâçéèêëíîïóôúûùüÿñæœ ]+$/|max:255',
            'id_tipo_entidad'   => 'required',
            'dni'               => 'integer|digits_between:7, 8',
            'cuit'              => 'integer|digits_between:11, 11',
            'cuil'              => 'integer|digits_between:11, 11',
            'telefono'          => 'integer|digits_between:7, 15',
            'email'             => 'max:255|email',
            'direccion'         => 'max:50|string',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'           => 'Ingrese nombre del nuevo iniciador.',
            'nombre.regex'              => 'Solo puede ingresar letras.',
            'nombre.max'                => 'Límite de caracteres alcanzado.',
            'apellido.regex'            => 'Solo puede ingresar letras.',
            'apellido.max'              => 'Límite de caracteres alcanzado.',
            'id_tipo_entidad.required'  => 'Seleccione el tipo de iniciador.',
            'dni.integer'               => 'Solo puede ingresar números.',
            'dni.digits_between'        => 'Debe ingresar un numero de 7 u 8 dígitos.',
            'cuit.integer'              => 'Solo puede ingresar números.',
            'cuit.digits_between'       => 'Debe ingresar un numero de 11 dígitos.',
            'cuil.integer'              => 'Solo puede ingresar números.',
            'cuil.digits_between'       => 'Debe ingresar un numero de 11 dígitos.',
            'telefono.integer'          => 'Solo puede ingresar números.',
            'telefono.digits_between'   => 'Debe ingresar entre 7 y 15 números.',
            'email.email'               => 'Ingrese un mail válido.',
            'direccion.max'             => 'Máximo 50 caracteres.'
        ];
    }
}
