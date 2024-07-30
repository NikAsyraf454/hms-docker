<?php

namespace App\Http\Controllers;


use App\Models\Claim;
use App\Models\ClaimType;
use App\Models\Fleet;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\ClaimService;

use Carbon\Carbon;

class ClaimController extends Controller
{
    protected $claimService;

    public function __construct(ClaimService $claimService){
        $this->claimService = $claimService;
    }

    public function home(){
        // $claims = Claim::paginate(5);

        return view('index');
    }

    public function index(Request $request){
        $user_id = $request->session()->get('user_id');
        //  $claims = DB::table('claims')
        //     ->join('users', 'claims.staff_id', '=', 'users.id')
        //     ->where('users.id', '=', $user_id)
        //     ->select(
        //         'claims.id as claim_id',
        //         'claims.details',
        //         'claims.amount',
        //         'claims.plate_number',
        //         'claims.status',
        //         'claims.date',
        //         'claims.payment_date',
        //         'users.name as user_name',
        //     )
        //     ->get();
            // dd($claims);
            // return response()->json($claims);
        // $claims = Claim::paginate(5);
        $claims = $this->claimService->listClaim($user_id);
        // return response()->json($claims);

        return view('claim.index')->with('claims', $claims);
    }

    public function create(){
        $fleet = Fleet::all();
        $claimType = ClaimType::all();
        // dd($fleet);
       return view('claim.create', compact('fleet','claimType'));
    }

    public function store(Request $request, $id){
        $claim_type_id = $request->input('claim_type_id');
        // dd($claim_type_id);

        if($id == 'members'){
            $data = $request->all();

            $data = $request->validate([
                'rental_id' => 'required',
                'details' => 'required',
                'staff_id' => 'required',
                'date' => 'required',
            ]);

            $data['category'] = 'members';
            // dd($data);
            $claim = $this->claimService->storeClaimMember($data);
            // dd($claim);

        }
        if($id == 'extra'){
            $data = $request->all();
            $data['category'] = 'extra';
            $claim = $this->claimService->storeClaimMember($data);
        }
        if($id == 'depo'){
            $data = $request->all();
            $data['category'] = 'depo';
            $claim = $this->claimService->storeClaimMember($data);
        }
        if($id == 'claim'){
            $request->validate([
                'details' => 'required|max:255',
                'amount' => 'required',
                'plate_number' => 'required',
                'date2' => 'required',
                'receipt' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            $data = $request->all();
            
            $data['category'] = 'claims';

            $file = $request->file('receipt');
            // dd($data);

            $claim = $this->claimService->storeClaim($data, $file);
            // dd($claim);
        }

        return redirect()->route('claim.index')
        ->with('success', 'Claim created successfully.');
    }

    public function show($id){
        $claim = Claim::find($id);

        $fileUrl = asset($claim->receipt);
        $extension = pathinfo($claim->receipt, PATHINFO_EXTENSION);

        $claim->extension = $extension;
        // return response()->json($claim);

        return view('claim.show', compact('claim'));
    }

    public function edit($id){
        $claim = Claim::find($id);
        return view('claim.edit', compact('claim'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'details' => 'required',
            'plate_number' => 'required',
        ]);

        $claim = Claim::find($id);
        $claim->update($request->all());
        return redirect()->route('claim.index')
        ->with('success', 'Claim updated successfully.');
    }

    public function destroy($id){
        $claim = Claim::find($id);
        $claim->delete();
        return redirect()->route('claim.index')
        ->with('success', 'Claim deleted successfully');
    }

    //Admin functions

    public function updateStatus(Claim $claim)
    {
        $claim->status = $claim->status === 'approved' ? 'declined' : 'approved';
        $currentDate = Carbon::now();
        // echo $currentDate;
        // exit;
        $claim->payment_date = $currentDate;
        $claim->save();

        return redirect()->back()->with('success', 'Claim status updated successfully.');
    }

    public function indexAdmin(){
         $claims = DB::table('claims')
            ->join('users', 'claims.staff_id', '=', 'users.id')
            // ->select(
            //     'claims.id as claim_id',
            //     'claims.details',
            //     'claims.amount',
            //     'claims.plate_number',
            //     'claims.status',
            //     'claims.date',
            //     'claims.payment_date',
            //     'users.name as user_name',
            // )
            ->get();

            // return response()->json($claims);
        return view('claim.admin.index')->with('claims', $claims);
    }
}
