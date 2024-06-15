@extends('layouts.layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Claim Form</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Vertical Form -->
            {{-- @dd($claim) --}}
            <form class="row g-3" action="{{ route('claim.update', $claim->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="col-12">
                <label for="details" class="form-label">Claim Detail</label>
                <input type="text" class="form-control" name="details" id="details" value="{{ $claim->details }}" readonly>
            </div>
            <div class="col-12">
                <label for="plate_number" class="form-label">Plate</label>
                <input type="text" class="form-control" name="plate_number" id="plate_number" value="{{$claim->plate_number}}" readonly>
            </div>
            <div class="col-12">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" name="date" id="date" value="{{$claim->date}}" readonly>
            </div>
            <div class="col-12">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" class="form-control" name="amount" id="amount" value="{{$claim->amount}}" readonly>
            </div>
            <div class="col-12">
                <div class="image-container">
                    <img src="{{ asset($claim->receipt) }}" alt="Receipt">
                </div>
            </div>
            <div class="text-center">
                <a href="{{route('claim.index')}}" class="btn btn-primary">Go Back</a>
            </div>
            </form><!-- Vertical Form -->

        </div>
    </div>

@endsection
