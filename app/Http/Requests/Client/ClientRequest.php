<?php

namespace App\Http\Requests\Client;

use App\Traits\SendResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClientRequest extends FormRequest
{
    use SendResponse;

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        if ($this->route()?->getName() == 'client.login') {
            return [
                'email' => 'required|email|exists:clients,email',
                'password' => 'required|string',
            ];
        }

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'birth_date' => 'required|date',
                        'phone_number' => 'required',
                        'email' => 'required|email|unique:clients',
                        'password' => 'required|string|confirmed',
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
