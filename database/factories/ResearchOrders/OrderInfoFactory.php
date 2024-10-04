<?php

namespace Database\Factories\ResearchOrders;

use App\Models\ResearchOrders\OrderInfo;
use App\Services\OrdersService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderInfo>
 */
class OrderInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $Order_ID = resolve(OrdersService::class);
        return [
            'Order_ID' => $Order_ID->getNewOrderID(),
            'user_id' => null,
            'client_id' => null,
        ];
    }
}
