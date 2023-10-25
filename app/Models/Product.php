<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends BaseModel
{
    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function Cart(){
        return $this->belongsToMany(Cart::class);
    }

    // I just use these cause i don't have s3 bucket credentials so i cant save s3 url, so i use this as a easy way to set images with any text to db
    protected function main_image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    protected function images(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
}
