<?php

namespace App\Services;

use App\Models\MaintenanceType;

class MaintenanceTypeService
{
    /**
     * Store a new customer.
     *
     * @param array $data
     * @return \App\Models\MaintenanceType
     */
    public function storeMaintenanceType(array $data)
    {
        // Create and return the customer
        $record = MaintenanceType::create($data);

        return $record->id;
    }

    public function getMaintenanceTypeById($recordId)
    {
        return MaintenanceType::find($recordId);
    }

    public function updateMaintenanceType($recordId, $data)
    {
        $record = MaintenanceType::find($recordId);
        if (!$record) {
            return null;
        }
        $record->update($data);
        return $record;
    }

    public function deleteMaintenanceType($customerId)
    {
        $record = MaintenanceType::find($recordId);
        if (!$record) {
            return null;
        }
        $record->delete();
        return $recordId;
    }

    public function listMaintenanceType()
    {
        return MaintenanceType::all();
    }
    
}
