@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- @dd($fleet) --}}

                        <h5 class="card-title">Edit Rental</h5>
                        <!-- Vertical Form -->
                        @php
                            $userId = session('user_id');
                        @endphp
                        <form action="{{ route('rental.update', $rental->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <input type="hidden" class="" id="staff_id" name="staff_id"
                                    value="{{ $userId }}">
                                <input type="hidden" class="" id="customer_id" name="customer_id"
                                    value="{{ $rental->customer_id }}">
                                {{-- Rental Detail --}}
                                <div class="col-6">
                                    <h4>Rental Info</h4>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="fleet_id" class="form-label">Plate Number</label>
                                            <input type="hidden" placeholder="" class="form-control" name="fleet_id"
                                                id="fleet_id" value="{{ $rental->fleet_id }}" readonly>
                                            <input type="text" placeholder="" class="form-control" name="fleet_id"
                                                id="fleet_id" value="{{ $rental->fleet->license_plate }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="pickup_date" class="form-label">Pickup Date</label>
                                            <input type="date" class="form-control" name="pickup_date" id="pickup_date"
                                                value="{{ $rental->pickup_date }}">
                                        </div>
                                        <div class="col-6">
                                            <label for="return_date" class="form-label">Return Date</label>
                                            <input type="date" class="form-control" name="return_date" id="return_date"
                                                value="{{ $rental->return_date }}">
                                        </div>
                                        @php
                                            // Generate times from 12:00 AM to 11:45 PM in 15-minute intervals
                                            $times = [];
                                            $startTime = strtotime('00:00'); // Start at midnight (24-hour format)
                                            $endTime = strtotime('23:45'); // End at 11:45 PM (24-hour format)
                                            while ($startTime <= $endTime) {
                                                $value = date('H:i:s', $startTime); // Value in 24-hour format (H:i)
                                                $display = date('h:i A', $startTime); // Display text in 12-hour format (h:i A)
                                                $times[] = ['value' => $value, 'display' => $display];
                                                $startTime = strtotime('+15 minutes', $startTime);
                                            }
                                        @endphp
                                        <div class="col-6">
                                            <label for="pickup_time" class="form-label">Pickup Time</label>
                                            <select class="form-select" name="pickup_time" required="required"
                                                id="pickup_time">
                                                @foreach ($times as $time)
                                                    <option value="{{ $time['value'] }}"
                                                        {{ $rental->pickup_time == $time['value'] ? 'selected' : '' }}>
                                                        {{ $time['display'] }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="col-6">
                                            <label for="return_time" class="form-label">Return Time</label>
                                            <select class="form-select" name="return_time" required="required"
                                                id="return_time">
                                                @foreach ($times as $time)
                                                    <option value="{{ $time['value'] }}"
                                                        {{ $rental->return_time == $time['value'] ? 'selected' : '' }}>
                                                        {{ $time['display'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="pickup_location" class="form-label"> Pickup Location</label>
                                            <input type="text" class="form-control" name="pickup_location"
                                                id="pickup_location" value="{{ $rental->pickup_location }}">
                                        </div>
                                        <div class="col-6">
                                            <label for="return_location" class="form-label">Return Location</label>
                                            <input type="text" class="form-control" name="return_location"
                                                id="return_location" value="{{ $rental->return_location }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="note" class="form-label">Note</label>
                                            <textarea name="note" class="form-control" id="note" cols="30" rows="5" value="{{ $rental->note }}"></textarea>
                                        </div>
                                        <div class="col-6">
                                            <label for="destination" class="form-label">Destination</label>
                                            <input type="text" class="form-control" name="destination"
                                                id="destination" value="{{ $rental->destination }}">
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <h5>Payment Details</h5>
                                        <div class="col-6">
                                            <label for="payment_status" class="form-label">Payment Status</label>
                                            <select class="form-control" name="payment_status" id="payment_status"
                                                value="{{ $rental->payment->payment_status }}">
                                                <option value="unpaid">Unpaid</option>
                                                <option value="paid">Paid</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="rental_amount" class="form-label">Rental Amount</label>
                                            <input type="number" class="form-control" name="rental_amount"
                                                id="rental_amount" value="{{ $rental->payment->rental_amount }}">
                                        </div>
                                        {{-- <div class="col-6">
                                            <label for="total_amount" class="form-label">Total Amount</label>
                                            <input type="number" class="form-control" name="total_amount"
                                                id="total_amount" value="{{ $rental->total_amount }}">
                                        </div> --}}
                                        @if (isset($rental->payment->proof))
                                            <div class="col-4 d-flex align-items-end pt-2">
                                                <a class="btn btn-light" href="{{ asset($rental->payment->proof) }}"
                                                    target="_blank">View</a>
                                            </div>
                                        @else
                                            <div class="col-md-12">
                                                <label for="inputNumber" class="col-sm col-form-label">Payment
                                                    Proof</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="payment_proof" id="payment_proof"
                                                        type="file" id="formFile">
                                                </div>
                                                @error('payment_proof')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="depo_amount" class="form-label">Depo Amount</label>
                                            <input type="number" class="form-control" name="depo_amount"
                                                id="depo_amount" value="{{ $rental->deposit->amount }}">
                                        </div>
                                        <div class="col-6">
                                            <label for="depo_date" class="form-label">Depo Date</label>
                                            <input type="date" class="form-control" name="depo_date" id="depo_date"
                                                value="{{ $rental->deposit->date }}">
                                        </div>
                                        <div class="col-6">
                                            <label for="depo_status" class="form-label">Deposit Status</label>
                                            <select class="form-control" name="depo_status" id="depo_status"
                                                value={{ $rental->deposit->status }}>
                                                <option value="unpaid">Unpaid</option>
                                                <option value="paid">Paid</option>
                                            </select>
                                        </div>
                                        @if (isset($rental->deposit->proof))
                                            <div class="col-4 d-flex align-items-end">
                                                <a class="btn btn-light" href="{{ asset($rental->deposit->proof) }}"
                                                    target="_blank">View</a>
                                            </div>
                                        @else
                                            {{-- Add Proof Logic --}}
                                        @endif

                                    </div>
                                </div>
                                {{-- Rental Detail --}}
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <!-- Vertical Form -->
                        {{-- <a href="{{ route('rental.inspection.create', ['id' => $rental->id]) }}"
                            class="btn btn-primary mt-2">Inspection Form</a> --}}

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
