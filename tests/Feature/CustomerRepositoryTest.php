<?php

namespace Tests\Feature;

use App\Http\Repositories\CustomerRepository;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class CustomerRepositoryTest extends TestCase
{

    public function setUp() : void
    {
        parent::setUp();
        $this->modelId = 1;
        $this->model = Mockery::mock(Customer::class);
    }

    public function test_can_get_customer_by_id()
    {
        $expecteModel = new Customer();
        $this->model->shouldReceive('findOrFail')->with($this->modelId)->andReturn($expecteModel);

        $repository = new CustomerRepository($this->model);
        $currentModel = $repository->getCustomerById($this->modelId);

        $this->assertEquals($expecteModel, $currentModel);
    }

    public function test_can_get_all_customers()
    {
        $expecteModels = new Collection([]);
        $this->model->shouldReceive('all')->andReturn($expecteModels);

        $repository = new CustomerRepository($this->model);
        $allModels = $repository->getAllCustomers();

        $this->assertEquals($expecteModels, $allModels);
    }

    public function test_can_update_or_create_customer()
    {
        $modelDetails = [
            'address' => 'test',
            'first_name' => 'test',
            'last_name' => 'test',
            'email' => 'test',
            'mobile' => '123456789',
        ];
        $expecteModel = new Customer($modelDetails);
        $this->model->shouldReceive('updateOrCreate')->with($modelDetails)->andReturn($expecteModel);

        $repository = new CustomerRepository($this->model);
        $updatedModel = $repository->updateOrCreateCustomer($modelDetails);

        $this->assertEquals($expecteModel, $updatedModel);
    }
}
