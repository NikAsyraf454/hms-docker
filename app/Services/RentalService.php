<?php

namespace App\Services;

use App\Models\Rental;
use App\Models\Inspection;

class RentalService
{
    /**
     * Store a new Rental.
     *
     * @param array $data
     * @return \App\Models\Customer
     */
    public function storeRental($data){
        // if($file){
        //     $filename = 'rentals/'.time(). '.' . $file->getClientOriginalExtension();  
        //     $file->move('rentals', $filename);
        // }else{
        //     $filename = null;
        // }

        if (!isset($data['note'])) {
            $data['note'] = null;
        }

        $data['pickup_time'] = date("H:i:s", strtotime($data['pickup_time']));
        $data['return_time'] = date("H:i:s", strtotime($data['return_time']));
      
        return Rental::create([
            'customer_id' => $data['customer_id'],
            'staff_id' => $data['staff_id'],
            'fleet_id' => $data['fleet_id'],
            'depo_id' => $data['depo_id'],
            'payment_id' => $data['payment_id'],
            'pickup_date' => $data['pickup_date'],
            'return_date' => $data['return_date'],
            'pickup_time' => $data['pickup_time'],
            'return_time' => $data['return_time'],
            'pickup_location' => $data['pickup_location'],
            'return_location' => $data['return_location'],
            'destination' => $data['destination'],
            // 'payment_status' => $data['payment_status'],
            // 'rental_amount' => $data['rental_amount'],
            // 'total_amount' => $data['total_amount'],
            // 'proof' => $filename,
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

    public function addInspectPhoto($file){
        $filename = 'pre'.time(). '.' . $file->getClientOriginalExtension();  
        $file->move('inspections', $filename);

        return $filename;
    }

    public function storeInspection($input,$gambar){
        // foreach($gambar as $g){
        //     if(!empty($g)){
        //         $filename = $this->addInspectPhoto($g);
        //     }
        // }

            $depan = $this->addInspectPhoto($gambar[0]);
            $belakang = $this->addInspectPhoto($gambar[1]);
            $kiri = $this->addInspectPhoto($gambar[2]);
            $kanan = $this->addInspectPhoto($gambar[3]);

            // $depan = '';
            // $belakang = '';
            // $kiri = '';
            // $kanan = '';
        
        if(isset($gambar[4])){
            $add1 = $this->addInspectPhoto($gambar[4]);
            $input['img_add1'] = $add1; 

        }
        if(isset($gambar[5])){
            $add2 = $this->addInspectPhoto($gambar[5]);
            $input['img_add2'] = $add2; 

        }

        $input['img_front'] = $depan; 
        $input['img_back'] = $belakang; 
        $input['img_left'] = $kiri; 
        $input['img_right'] = $kanan; 

        return Inspection::create($input);
    }
}
