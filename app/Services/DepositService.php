<?php

namespace App\Services;

use App\Models\Deposit;

class DepositService
{
    public function addDeposit($data, $file)
    {

        if($file){
            $filename = 'deposits/'.time(). '.' . $file->getClientOriginalExtension();  
            $file->move('deposits', $filename);
        }else{
            $filename = null;
        }

        return Deposit::create([
            'amount' => $data['depo_amount'],
            'date' => $data['depo_date'],
            'status' => $data['depo_status'],
            'proof' => $filename,
        ]);

    }

    public function getDepositById($epositId)
    {
        return Deposit::find($depositId);
    }

    public function updateDeposit($depositId, $data)
    {
        $deposit = Deposit::find($depositId);
        if (!$deposit) {
            return null;
        }
        $Deposit->update($data);
        return $Deposit;
    }

    public function deleteDeposit($depositId)
    {
        $deposit = Deposit::find($depositId);
        if (!$Deposit) {
            return null;
        }
        $deposit->delete();
        return $depositId;
    }

    public function listDeposit()
    {
        return Deposit::all();
    }

    public function addProof($file){
        $filename = time(). '.' . $file->getClientOriginalExtension();
        
        $file->move('deposits', $filename);
    }
}
