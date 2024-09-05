@extends('layouts.layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Deposit Details</h5>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @php
                $userId = session('user_id');
            @endphp
            <form action="{{ route('deposit.update', $depo->id) }}" method="POST">
                @csrf
                <input type="hidden" name="updated_by" value="{{ $userId }}">
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item">Amount : {{ $depo->amount }}</li>
                        <li class="list-group-item">Date : {{ $depo->date }}</li>
                        <li class="list-group-item">Status : {{ $depo->status }}</li>
                        <li class="list-group-item">Fuel : <input type="number" name="fuel" value="{{ $depo->fuel }}">
                        </li>
                        <li class="list-group-item">Late Return : <input type="number" name="late"
                                value="{{ $depo->late }}"></li>
                        <li class="list-group-item">Extend Rental : <input type="number" name="extend"
                                value="{{ $depo->extend }}"></li>
                        <li class="list-group-item">Return Date : <input type="date" name="return_date"
                                value="{{ $depo->return_date }}"></li>
                        <li class="list-group-item">Return Amount : <input type="number" name="return_amount"
                                value="{{ $depo->return_amount }}"></li>
                    </ul>
                    <div class="text-center pt-2">
                        <button type="submit" class="btn btn-primary">Submit Deduction</button>
                        <a href="{{ route('rental.index') }}" class="btn btn-warning">Go Back</a>
                    </div>
                </div>
            </form>

        </div>

    @endsection

    @push('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    @endpush
