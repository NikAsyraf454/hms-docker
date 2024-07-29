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

                        <h5 class="card-title">View Rental</h5>
                        <!-- Vertical Form -->
                        @php
                            $userId = session('user_id');
                        @endphp
                        <form action="" method="post">
                            @csrf
                            <div class="row">
                                <input type="hidden" class="" id="staff_id" name="staff_id"
                                    value="{{ $userId }}">
                                <input type="hidden" class="" id="customer_id" name="customer_id" value="">
                                {{-- Customer Detail --}}
                                <div class="col-6">
                                    <h4>Customer Info</h4>
                                    <div class="col-12">
                                        <label for="name" class="form-label">Customer Name</label>
                                        <input type="text" placeholder="Ahmad Irfan" class="form-control" name="name"
                                            id="name" value="{{ $rental->customer->name }}" disabled>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" placeholder="ahmad@graduate.utm.my" class="form-control"
                                                name="email" id="email" value="{{ $rental->customer->email }}" disabled>
                                        </div>
                                        <div class="col-6">
                                            <label for="ic" class="form-label">IC Number/Passport </label>
                                            <input type="number" placeholder="000627101198" class="form-control"
                                                name="ic" id="ic" value="{{ $rental->customer->ic }}" disabled>
                                        </div>
                                        <div class="col-6">
                                            <label for="matric" class="form-label">Matric</label>
                                            <input type="text" placeholder="A24EC0021" class="form-control"
                                                name="matric" id="matric" value="{{ $rental->customer->matric }}" disabled>
                                        </div>
                                        <div class="col-6">
                                            <label for="phone" class="form-label">Mobile Number </label>
                                            <input type="number" class="form-control" name="phone" id="phone"
                                                value="{{ $rental->customer->phone }}" disabled>
                                        </div>
                                        <div class="col-6">
                                            <label for="college" class="form-label">College </label>
                                            <input type="text" class="form-control"
                                                value="{{ $rental->customer->college }}" disabled>
                                        </div>
                                        <div class="col-6">
                                            <label for="faculty" class="form-label">Faculty </label>
                                            <input type="text" class="form-control"
                                                value="{{ $rental->customer->faculty }}" disabled>
                                        </div>
                                        <div class="col-6">
                                            <label for="address" class="form-label">Address </label>
                                            <input type="text" class="form-control" name="address" id="address"
                                                value="{{ $rental->customer->address }}" disabled>
                                        </div>

                                    </div>
                                    <div class="row pt-2">
                                        <h5>Bank Details</h5>
                                        <div class="col-6">
                                            <label for="bank" class="form-label">Bank</label>
                                             <input type="text" class="form-control" name="bank" id="bank"
                                                value="{{ $rental->customer->bank }}" disabled>
                                        </div>
                                        <div class="col-6">
                                            <label for="acc_num" class="form-label"> Account Number</label>
                                            <input type="text" placeholder="" class="form-control" name="acc_num"
                                                id="acc_num" value="{{ $rental->customer->acc_num }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                {{-- Rental Detail --}}
                                <div class="col-6">
                                    <h4>Rental Info</h4>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="license_plate" class="form-label">Plate Number</label>
                                            <input type="text" placeholder="" class="form-control" name="license_plate"
                                                id="license_plate" value="{{ $rental->fleet->license_plate }}" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="pickup_date" class="form-label">Pickup Date</label>
                                            <input type="date" class="form-control" name="pickup_date"
                                                id="pickup_date" value="{{ $rental->pickup_date }}" disabled>
                                        </div>
                                        <div class="col-6">
                                            <label for="return_date" class="form-label">Return Date</label>
                                            <input type="date" class="form-control" name="return_date"
                                                id="return_date" value="{{ $rental->return_date }}" disabled>
                                        </div>
                                        <div class="col-6">
                                            <label for="pickup_time" class="form-label">Pickup Time</label>
                                            <input type="date" class="form-control" name="pickup_time"
                                                id="pickup_time" value="{{ $rental->pickup_time }}" disabled>
                                        </div>
                                        <div class="col-6">
                                            <label for="return_time" class="form-label">Return Time</label>
                                            <input type="date" class="form-control" name="return_time"
                                                id="return_time" value="{{ $rental->return_time }}" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="pickup_location" class="form-label">Pickup Location</label>
                                            <input type="text" class="form-control" name="pickup_location"
                                                id="pickup_location" value="{{ $rental->pickup_location }}" disabled>
                                        </div>
                                        <div class="col-6">
                                            <label for="return_location" class="form-label">Return Location</label>
                                            <input type="text" class="form-control" name="return_location"
                                                id="return_location" value="{{ $rental->return_location}}" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="note" class="form-label">Note</label>
                                            <textarea name="note" class="form-control" disabled id="note" cols="30" rows="5"
                                                value="{{ $rental->note }}"></textarea>
                                        </div>
                                        <div class="col-6">
                                            <label for="destination" class="form-label">Destination</label>
                                            <input type="text" class="form-control" name="destination"
                                                id="destination" value="{{ $rental->destination }}" disabled>
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <h5>Payment Details</h5>
                                        <div class="col-6">
                                            <label for="payment_status" class="form-label">Payment Status</label>
                                            <input type="text" class="form-control" name="payment_status"
                                            id="payment_status" value="{{ $rental->payment_status }}" disabled>
                                        </div>
                                        <div class="col-6">
                                            <label for="rental_amount" class="form-label">Rental Amount</label>
                                            <input type="number" class="form-control" name="rental_amount"
                                                id="rental_amount" value="{{ $rental->rental_amount }}" disabled>
                                        </div>
                                        <div class="col-6">
                                            <label for="total_amount" class="form-label">Total Amount</label>
                                            <input type="number" class="form-control" name="total_amount"
                                                id="total_amount" value="{{ $rental->total_amount }}" disabled>
                                        </div>
                                        <div class="col-4 d-flex align-items-end">
                                                <a class="btn btn-light" href="{{ asset($rental->proof) }}" target="_blank">View</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-6">
                                                <label for="depo_amount" class="form-label">Depo Amount</label>
                                                <input type="number" class="form-control" name="depo_amount"
                                                    id="depo_amount" value="{{ $rental->deposit->amount }}" disabled>
                                            </div>
                                            <div class="col-6">
                                                <label for="depo_date" class="form-label">Depo Date</label>
                                                <input type="date" class="form-control" name="depo_date"
                                                    id="depo_date" value="{{ $rental->deposit->date}}" disabled>
                                            </div>
                                            <div class="col-6">
                                                <label for="depo_status" class="form-label">Deposit Status</label>
                                               <input type="date" class="form-control" name="depo_status"
                                                    id="depo_status" value="{{ $rental->deposit->status}}" disabled>
                                            </div>
                                            <div class="col-4 d-flex align-items-end">
                                                <a class="btn btn-light" href="{{ asset($rental->deposit->proof) }}" target="_blank">View</a>
                                            </div>
                                    </div>
                                </div>
                                {{-- Rental Detail --}}
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
