<?php

namespace Database\Factories\ResearchOrders;

use App\Models\ResearchOrders\OrderAttachment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderAttachment>
 */
class OrderAttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'File_Name' => $this->faker->unique()->word . '.pdf',
            'order_attachment_path' => $this->faker->url,
            'order_id' => null,
            'user_id' => null,
            'client_id' => null,
        ];
    }
}
