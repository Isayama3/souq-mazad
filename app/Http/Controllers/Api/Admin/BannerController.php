<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Controller;
use App\Models\Banner as Model;
use App\Http\Resources\Admin\BannerResource as Resource;
use App\Http\Requests\Admin\BannerRequest as FormRequest;

class BannerController extends Controller
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
