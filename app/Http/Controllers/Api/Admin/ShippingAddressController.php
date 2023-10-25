<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Controller;
use App\Models\ShippingAddress as Model;
use App\Http\Resources\Admin\ShippingAddressResource as Resource;
use App\Http\Requests\Admin\ShippingAddressRequest as FormRequest;

class ShippingAddressController extends Controller
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
        return [

        ];
    }
}
