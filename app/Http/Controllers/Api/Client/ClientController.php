<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\Controller;
use App\Models\Client as Model;
use App\Http\Resources\Client\ClientResource as Resource;
use App\Http\Requests\Client\ClientRequest as FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClientController extends Controller
{
    public function __construct(FormRequest $request, Model $model, $resource = Resource::class)
    {
        parent::__construct(
            $request,
            $model,
            $resource,
            hasDelete: true,
        );
    }

    public function relations(): array
    {
        return [];
    }

    public function login()
    {
        if (!auth()->guard('client')->attempt(['email' => $this->request->email, 'password' => $this->request->password])) {
            throw new HttpResponseException($this->request->ErrorMessage('بيانات الدخول غير صحيحة'));
        }

        $auth = auth()->guard('client-api')->user();

        $token = $auth->createToken('ClientApi')->plainTextToken;

        return $this->shortSuccess(
            [
                'token' => $token,
                'user' => Resource::make($auth),
            ],
            'تم تسجيل الدخول بنجاح',
        );
    }
}
