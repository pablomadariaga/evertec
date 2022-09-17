<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function getAllCustomers()
    {
        return Customer::all();
    }

    public function getCustomerById(int $CustomerId): Customer
    {
        return Customer::findOrFail($CustomerId);
    }

    public function updateOrCreateCustomer(array $customerDetails): Customer
    {
        unset($customerDetails['product']);
        return Customer::updateOrCreate($customerDetails);
    }
}
