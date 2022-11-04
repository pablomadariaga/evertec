<?php

namespace Tests\Feature;

use App\Http\Repositories\ProductRepository;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{

    public function setUp() : void
    {
        parent::setUp();
        $this->modelId = 1;
        $this->model = Mockery::mock(Product::class);
    }

    public function test_can_get_product_by_id()
    {
        $expecteModel = new Product();
        $this->model->shouldReceive('findOrFail')->with($this->modelId)->andReturn($expecteModel);

        $repository = new ProductRepository($this->model);
        $currentModel = $repository->getProductById($this->modelId);

        $this->assertEquals($expecteModel, $currentModel);
    }

    public function test_can_get_all_products()
    {
        $expecteModels = new Collection([]);
        $this->model->shouldReceive('all')->andReturn($expecteModels);

        $repository = new ProductRepository($this->model);
        $allModels = $repository->getAllProducts();

        $this->assertEquals($expecteModels, $allModels);
    }
}
