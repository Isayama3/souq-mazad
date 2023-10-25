<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Controller;
use App\Models\Category as Model;
use App\Http\Resources\Admin\CategoryResource as Resource;
use App\Http\Requests\Admin\CategoryRequest as FormRequest;

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

    public function store()
    {
        $record = $this->model->create($this->request->validated());

        // ----------------- Take A Look At Product Model Plz. ----------------//
        // ----------------- Take A Look At Product Model Plz. ----------------//
        
        // $main_image = $this->request->file('main_image');
        // $filename = uniqid() . '.' . $main_image->getClientOriginalExtension();
        // Storage::disk('s3')->putFileAs('main_images', $main_image, $filename, 'public');

        // foreach ($this->request->images as $image) {
        //     $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        //     Storage::disk('s3')->putFileAs('images', $image, $filename, 'public');
        // }
        
        // $file = Storage::disk('s3')->get('images/' . $filename);

        if (!empty($this->relations())) {
            $record = $record->load(...$this->relations());
        }

        $this->model = $record;
        return $this->sendResponse(
            new $this->resource($record),
            'تم الاضافة بنجاح',
            true,
            201
        );
    }
}
