<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    /**
     * Store a new customer.
     *
     * @param array $data
     * @return \App\Models\Customer
     */
    public function storeCustomer(array $data)
    {
        // Validate the data (optional, you can do validation in request class as well)
        // $validatedData = $this->validate($data);

        // Create and return the customer
        $customer = Customer::create($data);

        return $customer->id;
    }

    public function getCustomerById($customerId)
    {
        return Customer::find($customerId);
    }

    public function updateCustomer($customerId, $data)
    {
        $customer = Customer::find($customerId);
        if (!$customer) {
            return null;
        }
        $customer->update($data);
        return $customer;
    }

    public function deleteCustomer($customerId)
    {
        $customer = Customer::find($customerId);
        if (!$customer) {
            return null;
        }
        $customer->delete();
        return $customerId;
    }

    public function listCustomer()
    {
        return Customer::all();
    }
    
}
