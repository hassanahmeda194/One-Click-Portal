<?php

namespace Database\Factories\ResearchOrders;

use App\Models\ResearchOrders\OrderClientInfo;
use App\Services\OrdersService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderClientInfo>
 */
class OrderClientInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $Client_ID = resolve(OrdersService::class);
        return [
            'Client_Code' => $Client_ID->getNewClientID(),
            'Client_Name' => $this->faker->name,
            'Client_Country' => $this->faker->country,
            'Client_Email' => $this->faker->unique()->email,
            'Client_Phone' => $this->faker->phoneNumber,
        ];
    }
}
