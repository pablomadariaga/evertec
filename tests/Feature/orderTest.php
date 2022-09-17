<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Order;
use App\Models\Product;
use Database\Seeders\OrderStateSeeder;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMainPage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateOrder()
    {
        $customer = Customer::factory()->create();
        $product = Product::factory()->create();
        $this->seed(OrderStateSeeder::class);
        $test_order = [
            'address' => $customer->address,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'email' => $customer->email,
            'mobile' => $customer->mobile,
            'product' => $product->id,
        ];
        $response = $this->post('/order', $test_order);
        $response->assertStatus(200);

        $order = Order::where('customer_id', $customer->id)->first();

        $this->assertNotNull($order);

        // Ahora probamos con un usuario sin loguear
        $response = $this->post('/order', $test_order);
        $response->assertStatus(403);
    }
}
