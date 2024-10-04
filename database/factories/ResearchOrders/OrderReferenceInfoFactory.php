<?php

namespace Database\Factories\ResearchOrders;

use App\Models\ResearchOrders\OrderReferenceInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderReferenceInfo>
 */
class OrderReferenceInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Reference_Code' => $this->faker->unique(true)->randomNumber(),
            'order_id' => null,
            'user_id' => null,
            'client_id' => null,
        ];
    }
}
