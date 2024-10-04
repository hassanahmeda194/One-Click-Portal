<?php

namespace Database\Factories\ResearchOrders;

use App\Models\ResearchOrders\OrderBasicInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderBasicInfo>
 */
class OrderBasicInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Order_Services' => $this->faker->randomElement(['Research Report', 'Term Paper', 'Reflective Summary']),
            'Education_Level' => $this->faker->randomElement(['High School', 'College', 'University']),
            'Pages_Count' => $this->faker->numberBetween(1, 10),
            'Word_Count' => $this->faker->numberBetween(100, 5000),
            'Spacing' => $this->faker->randomElement(['1.5', '2.5', '0.5']),
            'Citation_Style' => $this->faker->randomElement(['APA', 'MLA', 'Chicago']),
            'Sources' => $this->faker->randomElement(['Source 1', 'Source 2', 'Source 3']),
            'Order_Website' => $this->faker->randomElement(['1Click', 'Click Writers', 'ABC']),
            'Order_Status' => $this->faker->randomElement([0, 1, 2, 3]),
            'order_id' => null,
            'user_id' => null,
            'client_id' => null,
        ];
    }
}
