<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'size:10', Rule::unique('products', 'code')->ignore($this->product)],
            'title' => ['required', Rule::unique('products', 'title')->ignore($this->product), 'max:100', 'string'],
            'description' => ['required', 'string', 'min:10', 'max:250'],
            'url' => ['required', Rule::unique('products', 'url')->ignore($this->product), 'min:6', 'max:100'],
            'image' => [
                $this->route('product') ? '' : 'required',
                'image',
                'max:2048'],
            'price' => ['required', 'integer', 'not_in:0'],
            'quantity' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El producto necesita un titulo.',
            'description.required' => 'El producto necesita una descripcion.',
            'url.required' => 'El producto necesita una descripcion.',

        ];
    }
}
