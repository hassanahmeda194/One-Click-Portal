<?php

namespace Database\Factories\ResearchOrders;

use App\Models\ResearchOrders\OrderDescriptionInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderDescriptionInfo>
 */
class OrderDescriptionInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Description' => $this->faker->text,
            'order_id' => null,
            'user_id' => null,
            'client_id' => null,
        ];
    }
}
