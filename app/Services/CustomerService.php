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

    /**
     * Validate the customer data.
     *
     * @param array $data
     * @return array
     */
    // protected function validate(array $data)
    // {
    //     return validator($data, [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:customers',
    //         'phone' => 'nullable|string|max:15',
    //         'address' => 'nullable|string|max:255',
    //     ])->validate();
    // }
}
