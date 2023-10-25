<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\SendResponse;

class ProductRequest extends FormRequest
{
    use SendResponse;

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'name' => 'required|string|max:255',
                        'description' => 'required|string',
                        'main_image' => 'required|file|image|mimes:jpeg,png,gif|dimensions:min_width=100,min_height=100|max:2048',
                        'images' => 'array',
                        'images.*' => 'file|image|mimes:jpeg,png,gif|dimensions:min_width=100,min_height=100|max:2048',
                        'old_price' => 'nullable|numeric|min:0',
                        'price' => 'required|numeric|min:0',
                    ];
                }
            case 'PUT': {
                    return [
                        'name' => 'nullable|string|max:255',
                        'description' => 'nullable|string',
                        'main_image' => 'nullable|file|image|mimes:jpeg,png,gif|dimensions:min_width=100,min_height=100|max:2048',
                        'images' => 'array',
                        'images.*' => 'file|image|mimes:jpeg,png,gif|dimensions:min_width=100,min_height=100|max:2048',
                        'old_price' => 'numeric|min:0',
                        'price' => 'nullable|numeric|min:0',
                    ];
                }
        }
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->ErrorValidate(
            $validator->errors()->toArray(),
        ));
    }
}
