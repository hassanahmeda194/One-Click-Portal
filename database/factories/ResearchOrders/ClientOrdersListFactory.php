<?php

namespace Database\Factories\ResearchOrders;

use App\Models\ResearchOrders\ClientOrdersList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ClientOrdersList>
 */
class ClientOrdersListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => null,
            'client_id' => null,
        ];
    }
}
