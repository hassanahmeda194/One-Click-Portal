<?php

namespace Database\Seeders;

use App\Models\Auth\User;
use App\Models\ResearchOrders\ClientOrdersList;
use App\Models\ResearchOrders\OrderAttachment;
use App\Models\ResearchOrders\OrderBasicInfo;
use App\Models\ResearchOrders\OrderClientInfo;
use App\Models\ResearchOrders\OrderDescriptionInfo;
use App\Models\ResearchOrders\OrderInfo;
use App\Models\ResearchOrders\OrderPaymentInfo;
use App\Models\ResearchOrders\OrderReferenceInfo;
use App\Models\ResearchOrders\OrderSubmissionInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $authUser = User::first();

        if ($authUser){
            for ($i = 0; $i < 50; $i++){
                OrderClientInfo::factory()->create([
                    'user_id' => $authUser->id,
                ])->each(function ($client) use ($authUser) {
                    $order = OrderInfo::factory()->create([
                        'user_id' => $authUser->id,
                        'client_id' => $client->id,
                    ]);

                    ClientOrdersList::factory()->create([
                        'order_id' => $order->id,
                        'client_id' => $client->id,
                    ]);

                    OrderBasicInfo::factory()->create([
                        'order_id' => $order->id,
                        'user_id' => $authUser->id,
                        'client_id' => $client->id,
                    ]);

                    OrderSubmissionInfo::factory()->create([
                        'order_id' => $order->id,
                        'user_id' => $authUser->id,
                        'client_id' => $client->id,
                    ]);

                    OrderReferenceInfo::factory()->create([
                        'order_id' => $order->id,
                        'user_id' => $authUser->id,
                        'client_id' => $client->id,
                    ]);

                    OrderDescriptionInfo::factory()->create([
                        'order_id' => $order->id,
                        'user_id' => $authUser->id,
                        'client_id' => $client->id,
                    ]);

                    OrderPaymentInfo::factory()->create([
                        'order_id' => $order->id,
                        'user_id' => $authUser->id,
                        'client_id' => $client->id,
                    ]);

                    OrderAttachment::factory()->create([
                        'order_id' => $order->id,
                        'user_id' => $authUser->id,
                        'client_id' => $client->id,
                    ]);
                });
            }
        }
        dump('Auth User!');
    }
}
