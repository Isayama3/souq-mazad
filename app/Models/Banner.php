<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Banner extends BaseModel
{
    protected function images(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
}
