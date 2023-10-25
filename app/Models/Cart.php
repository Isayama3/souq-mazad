<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Cart extends BaseModel
{
    public static function boot()
    {
        parent::boot();
        if (!is_null(auth()->guard('client-api')->user())) {
            static::addGlobalScope('clientCart', function (Builder $builder) {
                $builder->whereClientId(auth()->guard('client-api')->user()->id);
            });
        }
    }

    public function Client()
    {
        return $this->belongsTo(Client::class);
    }

    public function CartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
