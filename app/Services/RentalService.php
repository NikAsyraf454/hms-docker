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
    public function storeRental($data, $file)
    {
        if($file){
            $filename = 'rentals/'.time(). '.' . $file->getClientOriginalExtension();  
            $file->move('rentals', $filename);
        }else{
            $filename = null;
        }
      
        return Rental::create([
            'customer_id' => $data['customer_id'],
            'staff_id' => $data['staff_id'],
            'fleet_id' => $data['fleet_id'],
            'depo_id' => $data['depo_id'],
            'pickup_date' => $data['pickup_date'],
            'return_date' => $data['return_date'],
            'pickup_time' => $data['pickup_time'],
            'return_time' => $data['return_time'],
            'pickup_location' => $data['pickup_location'],
            'return_location' => $data['return_location'],
            'destination' => $data['destination'],
            'payment_status' => $data['payment_status'],
            'rental_amount' => $data['rental_amount'],
            'total_amount' => $data['total_amount'],
            'proof' => $filename,
            'note' => $data['note'],

        ]);
    }

    public function getRentalById($rentalId){
        return Rental::with('customer','staff:id,name','fleet:id,model,license_plate','deposit' )->find($rentalId);
    }

    public function updateRental($rentalId, $data){
        $rental = Rental::find($rentalId);
        if (!$rental) {
            return null;
        }
        $rental->update($data);
        return $rental;
    }

    public function deleteRental($rentalId){
        $rental = Rental::find($rentalId);
        if (!$rental) {
            return null;
        }
        $rental->delete();
        return $rentalId;
    }

    public function listRental(){
        return Rental::all();
    }

    public function addProof($file){
        $filename = time(). '.' . $file->getClientOriginalExtension();  
        $file->move('rentals', $filename);
    }
}
