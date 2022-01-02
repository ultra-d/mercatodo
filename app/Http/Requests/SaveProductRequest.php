<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'url' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El producto necesita un titulo.',
            'description.required' => 'El producto necesita una descripcion.',
            'url.required' => 'El producto necesita una descripcion.',

        ];
    }

}