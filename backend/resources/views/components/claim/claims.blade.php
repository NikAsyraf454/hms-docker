{{-- @dd($claim) --}}
<p>Staff Claim</p>
<div class="col-6">
<ul class="list-group">
    <li class="list-group-item">Details : {{$claim->details}}</li>
    <li class="list-group-item">Plate : {{$claim->plate_number}}</li>
    <li class="list-group-item">Date : {{$claim->date}}</li>
    <li class="list-group-item">Amount : {{$claim->amount}}</li>
    <li class="list-group-item d-flex flex-row">Receipt :  
         @isset($claim->receipt)
            <div class="ps-2">
                <a class="btn btn-primary" href="{{ asset($claim->receipt) }}" target="_blank">View</a>
            </div>
        @endisset
    </li>
    <li class="list-group-item">
        @if ($claim->status == 'approved')
            <span class="badge bg-success">Approved</span>
        @elseif($claim->status == 'declined')
            <span class="badge bg-danger">Declined</span>
        @else
            <span class="badge bg-warning">Pending</span>
        @endif
    </li>
</ul>
</div>
