<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\SendResponse;

class ShippingAddressRequest extends FormRequest
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
                        'latitude' => 'required|numeric',
                        'longitude' => 'required|numeric',
                        'address' => 'required|string',
                        'city' => 'required|string',
                        'country' => 'required|string',
                        'phone_number' => 'required|string',
                        'notes' => 'string|nullable',
                    ];
                }
            case 'PUT': {
                    return [
                        'latitude' => 'nullable|numeric',
                        'longitude' => 'nullable|numeric',
                        'address' => 'nullable|string',
                        'city' => 'nullable|string',
                        'country' => 'nullable|string',
                        'phone_number' => 'nullable|string',
                        'notes' => 'string|nullable',
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
