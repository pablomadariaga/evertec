<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    protected Customer $model;

    public function __construct(Customer $customer) {
        $this->model = $customer;
    }

    public function getAllCustomers()
    {
        return $this->model->all();
    }

    public function getCustomerById(int $customerId): Customer
    {
        return $this->model->findOrFail($customerId);
    }

    public function updateOrCreateCustomer(array $customerDetails): Customer
    {
        unset($customerDetails['product']);
        return $this->model->updateOrCreate($customerDetails);
    }
}
