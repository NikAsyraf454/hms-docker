@extends('layouts.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Claim Form</h5>
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
                    <form class="row g-3" action="{{ route('claim.update', $claim->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label for="details" class="form-label">Claim Detail</label>
                            <input type="text" class="form-control" name="details" id="details"
                                value="{{ $claim->details }}">
                        </div>
                        <div class="col-12">
                            <label for="plate_number" class="form-label">Plate</label>
                            <input type="text" class="form-control" name="plate_number" id="plate_number"
                                value="{{ $claim->plate_number }}">
                        </div>
                        <div class="col-12">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" id="date"
                                value="{{ $claim->date }}">
                        </div>
                        <div class="col-12">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" name="amount" id="amount"
                                value="{{ $claim->amount }}">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update Claim</button>
                            <button class="btn btn-sm" onclick="window.history.back()">Go Back</button>
                        </div>
                    </form><!-- Vertical Form -->
                </div>
            </div>
        </div>
    </div>




@endsection
