<?php

namespace App\Models;

class CartItem extends BaseModel
{
    public function Cart(){
        return $this->belongsTo(Cart::class,'cart_id');
    }

    public function Products(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
