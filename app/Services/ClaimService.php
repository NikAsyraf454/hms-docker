<?php

namespace App\Services;

use App\Models\Claim;
use Illuminate\Support\Facades\DB;

class ClaimService
{
    /**
     * Store a new Claim.
     *
     * @param array $data
     * @return \App\Models\Claim
     */
    public function storeClaim($data,$file)
    {
        $filename = time(). '.' . $file->getClientOriginalExtension();
        $file->move('receipts', $filename);

        $claim = new Claim();
        $claim->staff_id = $data['staff_id'];
        $claim->details = $data['details'];
        $claim->plate_number = $data['plate_number'];
        $claim->date = $data['date2'];
        $claim->amount = $data['amount'];
        $claim->category = $data['category'];
        $claim->receipt = 'receipts/'. $filename;
        $claim->save();

        return $claim;
    }

    public function storeClaimMember($data)
    {
        $claim = Claim::create($data);

        return $claim;
    }

    public function getClaimById($claimId)
    {
        return claim::find($claimId);
    }

    public function updateClaim($claimId, $data)
    {
        $claim = claim::find($claimId);
        if (!$claim) {
            return null;
        }
        $claim->update($data);
        return $claim;
    }

    public function deleteClaim($claimId)
    {
        $claim = claim::find($claimId);
        if (!$claim) {
            return null;
        }
        $claim->delete();
        return $claimId;
    }

    public function listClaim($user_id)
    {
        $claims = DB::table('claims')
            ->join('users', 'claims.staff_id', '=', 'users.id')
            ->where('users.id', '=', $user_id)
            ->get();

        return $claims;
        // return Rental::with('customer','staff:id,name','fleet:id,model,license_plate','deposit' )->find($rentalId);

        // return Claim::with('staff:id,name')->where('id',$user_id);
        // $claim = Claim::with('staff:id,name')->get();
    }
    
}
