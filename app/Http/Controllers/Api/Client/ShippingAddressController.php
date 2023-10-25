<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\Controller;
use App\Models\ShippingAddress as Model;
use App\Http\Resources\Client\ShippingAddressResource as Resource;
use App\Http\Requests\Client\ShippingAddressRequest as FormRequest;

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
