<?php

namespace Database\Factories;

use App\Models\ShippingAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShippingAddressFactory extends Factory
{
    protected $model = ShippingAddress::class;

    public function definition()
    {
        return [
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'phone_number' => $this->faker->phoneNumber,
            'notes' => $this->faker->sentence,
        ];
    }
}
