<?php

namespace App\Http\Controllers;


use App\Models\Claim;
use App\Models\Fleet;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ClaimController extends Controller
{

    public function home(){
        // $claims = Claim::paginate(5);

        return view('index');
    }

    public function index(Request $request){
        $user_id = $request->session()->get('user_id');
        $claims = DB::table('claims')
            ->join('users', 'claims.staff_id', '=', 'users.id')
            ->where('users.id', '=', $user_id)
            ->select(
                'claims.id as claim_id',
                'claims.details',
                'claims.amount',
                'claims.plate_number',
                'claims.status',
                'claims.date',
                'claims.payment_date',
                'users.name as user_name',
            )
            ->get();
            // dd($claims);
            // return response()->json($claims);
        // $claims = Claim::paginate(5);

        return view('claim.index')->with('claims', $claims);
    }

    public function create(){
        $fleet = Fleet::all();
        // dd($fleet);
       return view('claim.create', compact('fleet'));
    }

    public function store(Request $request){

        $request->validate([
        'details' => 'required|max:255',
        'amount' => 'required',
        'plate_number' => 'required',
        'date' => 'required',
        'receipt' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // dd($data);

        $file = $request->file('receipt');
        // dd($file);
        $filename = time(). '.' . $file->getClientOriginalExtension();
        // $uniqueId = Str::uuid()->toString();
        // $uniqueId = hashName();
        $filename = $filename. '.' . $file->getClientOriginalExtension();
        $file->move('receipts', $filename);

        $claim = new Claim();
        $claim->staff_id = $request->staff_id;
        $claim->details = $request->details;
        // $claim->broker = $request->broker;
        $claim->plate_number = $request->plate_number;
        $claim->date = $request->date;
        $claim->amount = $request->amount;
        $claim->receipt = 'receipts/'. $filename;
        $claim->save();

        // Claim::create($request->all());
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
            ->select(
                'claims.id as claim_id',
                'claims.details',
                'claims.amount',
                'claims.plate_number',
                'claims.status',
                'claims.date',
                'claims.payment_date',
                'users.name as user_name',
            )
            ->get();

        return view('claim.admin.index')->with('claims', $claims);
    }
}
