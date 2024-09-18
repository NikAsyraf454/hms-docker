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
                        <li class="list-group-item">Fuel : <input type="number" name="fuel" id="fuel"
                                value="{{ $depo->fuel }}">
                        </li>
                        <li class="list-group-item">Late Return : <input type="number" name="late" id="late"
                                value="{{ $depo->late }}"></li>
                        <li class="list-group-item">Extend Rental :
                            <input type="number" name="extend" value="{{ $depo->extend }}" id="extend">
                            <select name="extend_status" id="extend_status">
                                <option value="Paid" {{ $depo->extend_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                <option value="Unpaid" {{ $depo->extend_status == 'Unpaid' ? 'selected' : '' }}>Unpaid
                                </option>
                            </select>
                        </li>
                        <li class="list-group-item">Return Date : <input type="date" name="return_date"
                                value="{{ $depo->return_date }}"></li>
                        <li class="list-group-item">Return Amount : <input type="number" name="return_amount"
                                id="return_amount" value="{{ $depo->return_amount }}" readonly></li>
                    </ul>
                    @if (isset($depo->proof))
                        {{-- @dd($rental->deposit->proof) --}}

                        <div class="col-4 d-flex align-items-end">
                            <a class="btn btn-warning" href="{{ asset($depo->proof) }}" target="_blank">View</a>
                        </div>
                    @else
                        {{-- Add Proof Logic --}}
                    @endif
                    <div class="text-center pt-2">
                        <button type="submit" class="btn btn-primary">Submit Deduction</button>
                        <a href="{{ route('rental.index') }}" class="btn btn-warning">Back</a>
                    </div>
                </div>
            </form>

        </div>

    @endsection

    @section('script')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Ensure all elements are loaded before running the script
                const fuelElement = document.getElementById('fuel');
                const lateElement = document.getElementById('late');
                const extendElement = document.getElementById('extend');
                const extendStatusElement = document.getElementById('extend_status');
                const returnAmountElement = document.getElementById('return_amount');

                if (!fuelElement || !lateElement || !extendElement || !extendStatusElement || !returnAmountElement) {
                    console.error('One or more required elements not found');
                    return;
                }

                function calculateReturnAmount() {
                    // Use parseFloat to ensure we're working with numbers
                    const amount = parseFloat('{{ $depo->amount }}');
                    const fuel = parseFloat(fuelElement.value) || 0;
                    const late = parseFloat(lateElement.value) || 0;
                    const extend = parseFloat(extendElement.value) || 0;
                    const extendStatus = extendStatusElement.value;

                    let returnAmount = amount - fuel - late;

                    if (extendStatus === 'Unpaid') {
                        returnAmount -= extend;
                    }

                    // Use toFixed(2) to round to 2 decimal places, common for currency
                    returnAmountElement.value = returnAmount;

                    console.log('Return Amount:', returnAmount);
                }

                // Calculate initially
                calculateReturnAmount();

                // Recalculate when any input changes
                [fuelElement, lateElement, extendElement, extendStatusElement].forEach(element => {
                    element.addEventListener('input', calculateReturnAmount);
                });
            });
        </script>
    @endsection
