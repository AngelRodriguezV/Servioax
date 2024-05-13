<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DireccionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('Proveedor');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'calle' => 'required',
            'colonia' => 'required',
            'municipio' => 'estado',
            'num_exterior' => 'required|integer',
            'num_interior' => 'integer',
            'codigo_postal' => 'required|integer',
            'referencias' => 'required'
        ];
    }
}
