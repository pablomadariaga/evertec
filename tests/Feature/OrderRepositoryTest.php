<?php

namespace Tests\Feature;

use App\Http\Repositories\OrderRepository;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Database\Seeders\OrderStateSeeder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class OrderRepositoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() : void
    {
        parent::setUp();
        $this->modelId = 1;
        $this->model = Mockery::mock(Order::class);
        $this->modelRelation = Mockery::mock(OrderDetail::class);
        $this->modelDetails = [
            'reference' => 'test',
            'request_id' => 'test_evertec',
            'process_url' => 'test',
            'order_state_id' => '1',
            'product_id' => '1',
            'customer_id' => '1',
            'total' => '12345678',
        ];
    }

    public function test_can_get_order_by_id()
    {
        $expecteModel = new Order();
        $this->model->shouldReceive('findOrFail')->with($this->modelId)->andReturn($expecteModel);

        $repository = new OrderRepository($this->model);
        $currentModel = $repository->getOrderById($this->modelId);

        $this->assertEquals($expecteModel, $currentModel);
    }

    public function test_can_get_all_orders()
    {
        $expecteModels = new Collection([]);
        $this->model->shouldReceive('all')->andReturn($expecteModels);

        $repository = new OrderRepository($this->model);
        $allModels = $repository->getAllOrders();

        $this->assertEquals($expecteModels, $allModels);
    }

    public function test_can_get_all_orders_by_order_state()
    {
        $expecteModels = new Collection([]);
        $this->model->shouldReceive('getAllByOrderState')->with(1)->andReturn($expecteModels);

        $repository = new OrderRepository($this->model);
        $allModels = $repository->getAllOrdersByOrderState(1);

        $this->assertEquals($expecteModels, $allModels);
    }

    public function test_can_create_order()
    {
        $expecteModel = Order::factory()->create();
        $expectModelRelationId = Product::factory()->create();
        $this->model->shouldReceive('create')->with($this->modelDetails)->andReturn($expecteModel)
            ->shouldReceive('orderDetails')->andReturn($this->modelRelation);
        $this->modelRelation->shouldReceive('create')->with(
                ['product_id' => $expectModelRelationId->id]
            )->andReturn(new OrderDetail());

        $repository = new OrderRepository($this->model);
        $updatedModel = $repository->createOrder($this->modelDetails);

        $this->assertEquals($expecteModel, $updatedModel);
    }

    public function test_can_update_order()
    {

        $expecteModel = new Order($this->modelDetails);
        $this->model->shouldReceive('find')->with($this->modelId)->andReturn($expecteModel)
            ->shouldReceive('update')->with($this->modelDetails)->andReturn($expecteModel);

        $repository = new OrderRepository($this->model);
        $updatedModel = $repository->updateOrder($this->modelId, $this->modelDetails);

        $this->assertEquals($expecteModel, $updatedModel);
    }
}
