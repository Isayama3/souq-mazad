<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\ClientStatus;
use App\Http\Controllers\Api\Controller;
use App\Models\Client as Model;
use App\Http\Resources\Admin\ClientResource as Resource;
use App\Http\Requests\Admin\ClientRequest as FormRequest;

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

    public function blockClient($id)
    {
        $this->model->findOrFail($id)->update(['status' => ClientStatus::BLOCKED->value]);
        return $this->SuccessMessage('تم حظر العميل بنجاح');
    }
}
