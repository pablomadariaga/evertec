<?php

namespace App\Http\Interfaces;

use App\Models\Customer;

interface CustomerRepositoryInterface
{
    /**
     * Get all store customers
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\Customer>
     */
    public function getAllCustomers();

    /**
     * Get a store customer by id
     *
     * @param integer $customerId
     * @return Customer
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException<\Illuminate\Database\Eloquent\Model>
     */
    public function getCustomerById(int $customerId): Customer;


    /**
     * Save a new customer or update an exists and return the instance.
     *
     * @param array $customerDetails
     * @return Customer
     */
    public function updateOrCreateCustomer(array $customerDetails): Customer;
}
