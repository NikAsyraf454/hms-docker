{{-- @dd($claim) --}}
<p>Extra Job</p>
<div class="col-md-6">
    <ul class="list-group">
        <li class="list-group-item">Job Details : {{ $claim->details }}</li>
        <li class="list-group-item">Destination : {{ $claim->destination }}</li>
        <li class="list-group-item">Plate Number : {{ $claim->plate_number }}</li>
        <li class="list-group-item">Date : {{ $claim->date }}</li>
        <li class="list-group-item">Comission : {{ $claim->comission }}</li>
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
