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
        // $file->move('public/receipts', $filename); //for live server

        $claim = new Claim();
        $claim->staff_id = $data['staff_id'];
        $claim->details = $data['details'];
        $claim->plate_number = $data['plate_number'];
        $claim->date = $data['date-claim'];
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

    public function getMember($id){
         $claim = DB::table('claims')
            ->join('rentals', 'claims.rental_id', '=', 'rentals.id')
            ->where('rentals.id', '=', $id)
            ->select(
                'claims.id as claim_id',
                'claims.details',
                'claims.category',
                'claims.amount',
                'claims.plate_number',
                'claims.status',
                'claims.date',
                'claims.payment_date',
                'rentals.customer_id',
                'rentals.pickup_date',
                'rentals.return_date',
                'rentals.rental_amount',
            )
            ->get();

            return $claim;
    }   

    public function getCustomer($customer_id){
        // Second query to get customer details
        $customer = DB::table('customers')
            ->where('id', '=', $customer_id)
            ->select(
                'id',
                'name',
                'email',
                'phone',
                'address'
            )
            ->first(); 

        return $customer;
    }
    
}
