<?php

namespace App\Services;

use App\Models\MaintenanceRecord;

class MaintenanceRecordService
{
    /**
     * Store a new customer.
     *
     * @param array $data
     * @return \App\Models\MaintenanceRecord
     */
    public function storeMaintenance(array $data)
    {
        // Create and return the customer
        $record = MaintenanceRecord::create($data);

        return $record->id;
    }

    public function getMaintenanceById($recordId)
    {
        return MaintenanceRecord::find($recordId);
    }

    public function updateMaintenance($recordId, $data)
    {
        $record = MaintenanceRecord::find($recordId);
        if (!$record) {
            return null;
        }
        $record->update($data);
        return $record;
    }

    public function deleteMaintenance($customerId)
    {
        $record = MaintenanceRecord::find($recordId);
        if (!$record) {
            return null;
        }
        $record->delete();
        return $recordId;
    }

    public function listMaintenance()
    {
        return MaintenanceRecord::all();
    }
    
}
