<?php

namespace App\Services;

use App\Models\Deposit;

class DepositService
{
    public function addDeposit($data, $file)
    {
        $newArray;
        $newArray['amount'] = $data['depo_amount'];
        $newArray['date'] = $data['depo_date'];
        $newArray['status'] = $data['depo_status'];
        // $newArray['return_date'] = $data['depo_amount'];
        // dd($newArray);

        $filename = time(). '.' . $file->getClientOriginalExtension();  
        $file->move('deposits', $filename);
        //    return Rental::create($data);
        return Deposit::create([
            'amount' => $data['depo_amount'],
            'date' => $data['depo_date'],
            'status' => $data['depo_status'],
            'proof' => 'deposits/'.$filename,
        ]);

        return Deposit::create($newArray);
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
