<?php

namespace Database\Factories\ResearchOrders;

use App\Models\ResearchOrders\OrderPaymentInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderPaymentInfo>
 */
class OrderPaymentInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Order_Price' => $this->faker->randomFloat(2, 10, 100),
            'Order_Discount' => $this->faker->randomFloat(2, 0, 10),
            'Order_Currency' => $this->faker->randomElement(['USD', 'EUR', 'GBP']),
            'Payment_Status' => $this->faker->randomElement([0, 1, 2]),
            'Rec_Amount' => $this->faker->randomFloat(2, 0, 50),
            'Due_Amount' => $this->faker->randomFloat(2, 0, 50),
            'Partial_Info' => $this->faker->sentence,
            'order_id' => null,
            'user_id' => null,
            'client_id' => null,
        ];
    }
}
