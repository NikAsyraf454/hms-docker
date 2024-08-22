<?php

namespace App\Services;

use App\Models\Inspection;
use Illuminate\Support\Facades\DB;

class InspectionService
{
    public function addInspection($data)
    {
        $gambar = [
            'front' => $data['img_front'],
            'left' => $data['img_left'],
            'right' => $data['img_right'],
            'back' => $data['img_back']
        ];
        
        $names = [];

        foreach ($gambar as $image) {
            $destinationPath = 'inspections/';
            $filename = date('Ymd'). '_' . $image->getClientOriginalName();
            $image->move($destinationPath, $filename);
            array_push($names, $filename); 
        }

        $korok = implode(',', $names);
        $data['image'] = json_encode($korok);
        $data['type'] = 'pre';

        $inspection = new Inspection();

        $inspection->rental_id = $data['rental_id'];
        $inspection->staff_id = $data['staff_id'];
        $inspection->type = $data['type'];
        $inspection->parts = json_encode($data['parts']);
        $inspection->mileage = $data['mileage'];
        $inspection->fuel = $data['fuel'];
        $inspection->remarks = $data['remarks'];
        $inspection->image = $data['image'];
        $inspection->save();

        return $inspection;

        // return Inspection::create($data);
    }

    public function getInspectionById($rentalId, $type){
        $exists = Inspection::where('rental_id', $rentalId)->exists();
    }
    
}
