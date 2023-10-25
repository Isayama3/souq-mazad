<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\Controller;
use App\Models\Category as Model;
use App\Http\Resources\Client\CategoryResource as Resource;
use App\Http\Requests\Client\CategoryRequest as FormRequest;

class CategoryController extends Controller
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
