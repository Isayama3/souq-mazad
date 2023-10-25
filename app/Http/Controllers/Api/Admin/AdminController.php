<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Controller;
use App\Models\Admin as Model;
use App\Http\Resources\Admin\AdminResource as Resource;
use App\Http\Requests\Admin\AdminRequest as FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdminController extends Controller
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
        if (!auth()->guard('admin')->attempt(['email' => $this->request->email, 'password' => $this->request->password])) {
            throw new HttpResponseException($this->request->ErrorMessage('بيانات الدخول غير صحيحة'));
        }

        $auth = auth()->guard('admin-api')->user();

        $token = $auth->createToken('AdminApi')->plainTextToken;

        return $this->shortSuccess(
            [
                'token' => $token,
                'user' => Resource::make($auth),
            ],
            'تم تسجيل الدخول بنجاح',
        );
    }
}
