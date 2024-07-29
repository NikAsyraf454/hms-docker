<?php

namespace App\Services;

use App\Models\Rental;

class RentalService
{
    /**
     * Store a new Rental.
     *
     * @param array $data
     * @return \App\Models\Customer
     */
    public function storeRental(array $data)
    {
       return Rental::create($data);
    }

    public function getRentalById($rentalId)
    {
        return Rental::with('customer','staff:id,name','fleet:id,model,license_plate','deposit' )->find($rentalId);
    }

    public function updateRental($rentalId, $data)
    {
        $rental = Rental::find($rentalId);
        if (!$rental) {
            return null;
        }
        $rental->update($data);
        return $rental;
    }

    public function deleteRental($rentalId)
    {
        $rental = Rental::find($rentalId);
        if (!$rental) {
            return null;
        }
        $rental->delete();
        return $rentalId;
    }

    public function listRental()
    {
        return Rental::all();
    }
}
