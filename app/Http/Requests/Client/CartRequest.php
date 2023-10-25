<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\SendResponse;

class CartRequest extends FormRequest
{
    use SendResponse;

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        if ($this->route()?->getName() == 'client.add-to-cart') {
            return [
                'products' => 'required|array',
                'products.*.product_id' => 'required|exists:products,id',
                'products.*.quantity' => 'required',
            ];
        }

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        
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
