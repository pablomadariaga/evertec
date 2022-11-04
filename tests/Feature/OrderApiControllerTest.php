<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\OrderApiController;
use App\Http\Interfaces\CustomerRepositoryInterface;
use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class OrderApiControllerTest extends TestCase
{
    public \Mockery\MockInterface|\Mockery\LegacyMockInterface $orderRepositoryInterface;
    public \Mockery\MockInterface|\Mockery\LegacyMockInterface $customerRepositoryInterface;
    public \Mockery\MockInterface|\Mockery\LegacyMockInterface $productRepositoryInterface;
    public OrderApiController $controller;


    public function setUp():void
    {
        parent::setUp();
        $this->orderRepositoryInterface = Mockery::mock(OrderRepositoryInterface::class);
        $this->customerRepositoryInterface = Mockery::mock(CustomerRepositoryInterface::class);
        $this->productRepositoryInterface = Mockery::mock(ProductRepositoryInterface::class);
        $this->controller = new OrderApiController(
            $this->orderRepositoryInterface,
            $this->customerRepositoryInterface,
            $this->productRepositoryInterface
        );
    }

    /**
     * test index order list api controller
     *
     * @return void
     */
    public function test_index_order_list()
    {
        $expecteModels = new Collection([]);
        $this->orderRepositoryInterface->shouldReceive('getAllOrders')->andReturns($expecteModels);
        $allModels = $this->controller->index();

        $this->assertEquals($expecteModels, $allModels->original['data']);
    }

}
