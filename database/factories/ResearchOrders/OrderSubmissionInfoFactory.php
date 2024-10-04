<?php

namespace Database\Factories\ResearchOrders;

use App\Models\ResearchOrders\OrderSubmissionInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderSubmissionInfo>
 */
class OrderSubmissionInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'DeadLine' => $this->faker->date(),
            'DeadLine_Time' => $this->faker->time(),
            'F_DeadLine' => $this->faker->date(),
            'S_DeadLine' => $this->faker->date(),
            'T_DeadLine' => $this->faker->date(),
            'order_id' => null,
            'user_id' => null,
            'client_id' => null,
        ];
    }
}
