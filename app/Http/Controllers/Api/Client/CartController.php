<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\Controller;
use App\Models\Cart as Model;
use App\Http\Resources\Client\CartResource as Resource;
use App\Http\Requests\Client\CartRequest as FormRequest;

class CartController extends Controller
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
            'CartItems',
            'CartItems.Products'
        ];
    }

    public function addToCart()
    {
        auth()->guard('client-api')->user()->Cart()->firstOrCreate();

        $cart_items = auth()->guard('client-api')->user()->Cart;

        if ($cart_items->CartItems->isEmpty()) {
            $cart_items->CartItems()->createMany($this->request->products);
        } else {
            foreach ($this->request->products as $product) {
                $cart_item = $cart_items->CartItems()->where('product_id', $product['product_id'])->first();

                if (is_null($cart_item)) {
                    $cart_items->CartItems()->create($product);
                } else {
                    $cart_item->quantity = $cart_item->quantity + $product['quantity'];
                    $cart_item->save();
                }
            }
        }

        return $this->SuccessMessage('تم الإضافة للعربة بنجاح');
    }
}
