<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\SendResponse;

class BannerRequest extends FormRequest
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
                        'images' => 'required|array',
                        'images.*' => 'required|file|image|mimes:jpeg,png,gif|dimensions:min_width=100,min_height=100|max:2048',
                    ];
                }
            case 'PUT': {
                    return [];
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
