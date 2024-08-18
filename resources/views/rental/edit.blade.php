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
                        <form action="{{ route('rental.update', $rental->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <input type="hidden" class="" id="staff_id" name="staff_id"
                                    value="{{ $userId }}">
                                <input type="hidden" class="" id="customer_id" name="customer_id"
                                    value="{{ $rental->customer_id }}">
                                {{-- Customer Detail --}}
                                {{-- <div class="col-6">
                                    <h4>Customer Info</h4>
                                    <div class="col-12">
                                        <label for="name" class="form-label">Customer Name</label>
                                        <input type="text" placeholder="Ahmad Irfan" class="form-control" name="name"
                                            id="name" value="{{ $rental->customer->name }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" placeholder="ahmad@graduate.utm.my" class="form-control"
                                                name="email" id="email" value="{{ $rental->customer->email }}">
                                        </div>
                                        <div class="col-6">
                                            <label for="ic" class="form-label">IC Number/Passport </label>
                                            <input type="number" placeholder="000627101198" class="form-control"
                                                name="ic" id="ic" value="{{ $rental->customer->ic }}">
                                        </div>
                                        <div class="col-6">
                                            <label for="matric" class="form-label">Matric</label>
                                            <input type="text" placeholder="A24EC0021" class="form-control"
                                                name="matric" id="matric" value="{{ $rental->customer->matric }}">
                                        </div>
                                        <div class="col-6">
                                            <label for="phone" class="form-label">Mobile Number </label>
                                            <input type="number" class="form-control" name="phone" id="phone"
                                                value="{{ $rental->customer->phone }}">
                                        </div>
                                        <div class="col-6">
                                            <label for="college" class="form-label">College </label>
                                            <select class="form-control" name="college" id="college"
                                                value="{{ $rental->customer->college }}">
                                                <option value="KRP">KRP</option>
                                                <option value="KTF">KTF</option>
                                                <option value="KTC">KTC</option>
                                                <option value="KP">KP</option>
                                                <option value="KTHO">KTHO</option>
                                                <option value="KTR">KTR</option>
                                                <option value="KTDI">KTDI</option>
                                                <option value="K9">K9</option>
                                                <option value="K10">K10</option>
                                                <option value="KDSE">KDSE</option>
                                                <option value="KDOJ">KDOJ</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="faculty" class="form-label">Faculty </label>
                                            <select class="form-control" name="faculty" id="faculty"
                                                value="{{ $rental->customer->faculty }}">
                                                <option value="FC">Civil Engineering</option>
                                                <option value="FM">Mechanical Engineering</option>
                                                <option value="FE">Electrical Engineering</option>
                                                <option value="FCS">Computing</option>
                                                <option value="FS">Science</option>
                                                <option value="FABU">FABU</option>
                                                <option value="FSSH">FSSH</option>
                                                <option value="Management">Management</option>
                                                <option value="AHIBS">AHIBS</option>
                                                <option value="MJIIT">MJIIT</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="address" class="form-label">Address </label>
                                            <input type="text" class="form-control" name="address" id="address"
                                                value="{{ $rental->customer->address }}">
                                        </div>

                                    </div>
                                    <div class="row pt-2">
                                        <h5>Bank Details</h5>
                                        <div class="col-6">
                                            <label for="bank" class="form-label">Bank</label>
                                            <input type="text" class="form-control" name="bank" id="bank"
                                                value="{{ $rental->customer->bank }}">
                                        </div>
                                        <div class="col-6">
                                            <label for="acc_num" class="form-label"> Account Number</label>
                                            <input type="text" placeholder="" class="form-control" name="acc_num"
                                                id="acc_num" value="{{ $rental->customer->acc_num }}">
                                        </div>
                                    </div>
                                </div> --}}
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
                                        <div class="col-6">
                                            <label for="pickup_time" class="form-label">Pickup Time</label>
                                            <select class="form-select" name="pickup_time" required="required"
                                                id="pickup_time" value="{{ $rental->pickup_time }}">
                                                <option value="12:00 AM">12:00 AM</option>
                                                <option value="12:15 AM">12:15 AM</option>
                                                <option value="12:30 AM">12:30 AM</option>
                                                <option value="12:45 AM">12:45 AM</option>
                                                <option value="1:00 AM">1:00 AM</option>
                                                <option value="1:15 AM">1:15 AM</option>
                                                <option value="1:30 AM">1:30 AM</option>
                                                <option value="1:45 AM">1:45 AM</option>
                                                <option value="2:00 AM">2:00 AM</option>
                                                <option value="2:15 AM">2:15 AM</option>
                                                <option value="2:30 AM">2:30 AM</option>
                                                <option value="2:45 AM">2:45 AM</option>
                                                <option value="3:00 AM">3:00 AM</option>
                                                <option value="3:15 AM">3:15 AM</option>
                                                <option value="3:30 AM">3:30 AM</option>
                                                <option value="3:45 AM">3:45 AM</option>
                                                <option value="4:00 AM">4:00 AM</option>
                                                <option value="4:15 AM">4:15 AM</option>
                                                <option value="4:30 AM">4:30 AM</option>
                                                <option value="4:45 AM">4:45 AM</option>
                                                <option value="5:00 AM">5:00 AM</option>
                                                <option value="5:15 AM">5:15 AM</option>
                                                <option value="5:30 AM">5:30 AM</option>
                                                <option value="5:45 AM">5:45 AM</option>
                                                <option value="6:00 AM">6:00 AM</option>
                                                <option value="6:15 AM">6:15 AM</option>
                                                <option value="6:30 AM">6:30 AM</option>
                                                <option value="6:45 AM">6:45 AM</option>
                                                <option value="7:00 AM">7:00 AM</option>
                                                <option value="7:15 AM">7:15 AM</option>
                                                <option value="7:30 AM">7:30 AM</option>
                                                <option value="7:45 AM">7:45 AM</option>
                                                <option value="8:00 AM">8:00 AM</option>
                                                <option value="8:15 AM">8:15 AM</option>
                                                <option value="8:30 AM">8:30 AM</option>
                                                <option value="8:45 AM">8:45 AM</option>
                                                <option value="9:00 AM" selected="selected">9:00 AM</option>
                                                <option value="9:15 AM">9:15 AM</option>
                                                <option value="9:30 AM">9:30 AM</option>
                                                <option value="9:45 AM">9:45 AM</option>
                                                <option value="10:00 AM">10:00 AM</option>
                                                <option value="10:15 AM">10:15 AM</option>
                                                <option value="10:30 AM">10:30 AM</option>
                                                <option value="10:45 AM">10:45 AM</option>
                                                <option value="11:00 AM">11:00 AM</option>
                                                <option value="11:15 AM">11:15 AM</option>
                                                <option value="11:30 AM">11:30 AM</option>
                                                <option value="11:45 AM">11:45 AM</option>
                                                <option value="12:00 PM">12:00 PM</option>
                                                <option value="12:15 PM">12:15 PM</option>
                                                <option value="12:30 PM">12:30 PM</option>
                                                <option value="12:45 PM">12:45 PM</option>
                                                <option value="1:00 PM">1:00 PM</option>
                                                <option value="1:15 PM">1:15 PM</option>
                                                <option value="1:30 PM">1:30 PM</option>
                                                <option value="1:45 PM">1:45 PM</option>
                                                <option value="2:00 PM">2:00 PM</option>
                                                <option value="2:15 PM">2:15 PM</option>
                                                <option value="2:30 PM">2:30 PM</option>
                                                <option value="2:45 PM">2:45 PM</option>
                                                <option value="3:00 PM">3:00 PM</option>
                                                <option value="3:15 PM">3:15 PM</option>
                                                <option value="3:30 PM">3:30 PM</option>
                                                <option value="3:45 PM">3:45 PM</option>
                                                <option value="4:00 PM">4:00 PM</option>
                                                <option value="4:15 PM">4:15 PM</option>
                                                <option value="4:30 PM">4:30 PM</option>
                                                <option value="4:45 PM">4:45 PM</option>
                                                <option value="5:00 PM">5:00 PM</option>
                                                <option value="5:15 PM">5:15 PM</option>
                                                <option value="5:30 PM">5:30 PM</option>
                                                <option value="5:45 PM">5:45 PM</option>
                                                <option value="6:00 PM">6:00 PM</option>
                                                <option value="6:15 PM">6:15 PM</option>
                                                <option value="6:30 PM">6:30 PM</option>
                                                <option value="6:45 PM">6:45 PM</option>
                                                <option value="7:00 PM">7:00 PM</option>
                                                <option value="7:15 PM">7:15 PM</option>
                                                <option value="7:30 PM">7:30 PM</option>
                                                <option value="7:45 PM">7:45 PM</option>
                                                <option value="8:00 PM">8:00 PM</option>
                                                <option value="8:15 PM">8:15 PM</option>
                                                <option value="8:30 PM">8:30 PM</option>
                                                <option value="8:45 PM">8:45 PM</option>
                                                <option value="9:00 PM">9:00 PM</option>
                                                <option value="9:15 PM">9:15 PM</option>
                                                <option value="9:30 PM">9:30 PM</option>
                                                <option value="9:45 PM">9:45 PM</option>
                                                <option value="10:00 PM">10:00 PM</option>
                                                <option value="10:15 PM">10:15 PM</option>
                                                <option value="10:30 PM">10:30 PM</option>
                                                <option value="10:45 PM">10:45 PM</option>
                                                <option value="11:00 PM">11:00 PM</option>
                                                <option value="11:15 PM">11:15 PM</option>
                                                <option value="11:30 PM">11:30 PM</option>
                                                <option value="11:45 PM">11:45 PM</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="return_time" class="form-label">Return Time</label>
                                            <select class="form-select" name="return_time" required="required"
                                                id="return_time" value="{{ $rental->return_time }}">
                                                <option value="12:00 AM">12:00 AM</option>
                                                <option value="12:15 AM">12:15 AM</option>
                                                <option value="12:30 AM">12:30 AM</option>
                                                <option value="12:45 AM">12:45 AM</option>
                                                <option value="1:00 AM">1:00 AM</option>
                                                <option value="1:15 AM">1:15 AM</option>
                                                <option value="1:30 AM">1:30 AM</option>
                                                <option value="1:45 AM">1:45 AM</option>
                                                <option value="2:00 AM">2:00 AM</option>
                                                <option value="2:15 AM">2:15 AM</option>
                                                <option value="2:30 AM">2:30 AM</option>
                                                <option value="2:45 AM">2:45 AM</option>
                                                <option value="3:00 AM">3:00 AM</option>
                                                <option value="3:15 AM">3:15 AM</option>
                                                <option value="3:30 AM">3:30 AM</option>
                                                <option value="3:45 AM">3:45 AM</option>
                                                <option value="4:00 AM">4:00 AM</option>
                                                <option value="4:15 AM">4:15 AM</option>
                                                <option value="4:30 AM">4:30 AM</option>
                                                <option value="4:45 AM">4:45 AM</option>
                                                <option value="5:00 AM">5:00 AM</option>
                                                <option value="5:15 AM">5:15 AM</option>
                                                <option value="5:30 AM">5:30 AM</option>
                                                <option value="5:45 AM">5:45 AM</option>
                                                <option value="6:00 AM">6:00 AM</option>
                                                <option value="6:15 AM">6:15 AM</option>
                                                <option value="6:30 AM">6:30 AM</option>
                                                <option value="6:45 AM">6:45 AM</option>
                                                <option value="7:00 AM">7:00 AM</option>
                                                <option value="7:15 AM">7:15 AM</option>
                                                <option value="7:30 AM">7:30 AM</option>
                                                <option value="7:45 AM">7:45 AM</option>
                                                <option value="8:00 AM">8:00 AM</option>
                                                <option value="8:15 AM">8:15 AM</option>
                                                <option value="8:30 AM">8:30 AM</option>
                                                <option value="8:45 AM">8:45 AM</option>
                                                <option value="9:00 AM" selected="selected">9:00 AM</option>
                                                <option value="9:15 AM">9:15 AM</option>
                                                <option value="9:30 AM">9:30 AM</option>
                                                <option value="9:45 AM">9:45 AM</option>
                                                <option value="10:00 AM">10:00 AM</option>
                                                <option value="10:15 AM">10:15 AM</option>
                                                <option value="10:30 AM">10:30 AM</option>
                                                <option value="10:45 AM">10:45 AM</option>
                                                <option value="11:00 AM">11:00 AM</option>
                                                <option value="11:15 AM">11:15 AM</option>
                                                <option value="11:30 AM">11:30 AM</option>
                                                <option value="11:45 AM">11:45 AM</option>
                                                <option value="12:00 PM">12:00 PM</option>
                                                <option value="12:15 PM">12:15 PM</option>
                                                <option value="12:30 PM">12:30 PM</option>
                                                <option value="12:45 PM">12:45 PM</option>
                                                <option value="1:00 PM">1:00 PM</option>
                                                <option value="1:15 PM">1:15 PM</option>
                                                <option value="1:30 PM">1:30 PM</option>
                                                <option value="1:45 PM">1:45 PM</option>
                                                <option value="2:00 PM">2:00 PM</option>
                                                <option value="2:15 PM">2:15 PM</option>
                                                <option value="2:30 PM">2:30 PM</option>
                                                <option value="2:45 PM">2:45 PM</option>
                                                <option value="3:00 PM">3:00 PM</option>
                                                <option value="3:15 PM">3:15 PM</option>
                                                <option value="3:30 PM">3:30 PM</option>
                                                <option value="3:45 PM">3:45 PM</option>
                                                <option value="4:00 PM">4:00 PM</option>
                                                <option value="4:15 PM">4:15 PM</option>
                                                <option value="4:30 PM">4:30 PM</option>
                                                <option value="4:45 PM">4:45 PM</option>
                                                <option value="5:00 PM">5:00 PM</option>
                                                <option value="5:15 PM">5:15 PM</option>
                                                <option value="5:30 PM">5:30 PM</option>
                                                <option value="5:45 PM">5:45 PM</option>
                                                <option value="6:00 PM">6:00 PM</option>
                                                <option value="6:15 PM">6:15 PM</option>
                                                <option value="6:30 PM">6:30 PM</option>
                                                <option value="6:45 PM">6:45 PM</option>
                                                <option value="7:00 PM">7:00 PM</option>
                                                <option value="7:15 PM">7:15 PM</option>
                                                <option value="7:30 PM">7:30 PM</option>
                                                <option value="7:45 PM">7:45 PM</option>
                                                <option value="8:00 PM">8:00 PM</option>
                                                <option value="8:15 PM">8:15 PM</option>
                                                <option value="8:30 PM">8:30 PM</option>
                                                <option value="8:45 PM">8:45 PM</option>
                                                <option value="9:00 PM">9:00 PM</option>
                                                <option value="9:15 PM">9:15 PM</option>
                                                <option value="9:30 PM">9:30 PM</option>
                                                <option value="9:45 PM">9:45 PM</option>
                                                <option value="10:00 PM">10:00 PM</option>
                                                <option value="10:15 PM">10:15 PM</option>
                                                <option value="10:30 PM">10:30 PM</option>
                                                <option value="10:45 PM">10:45 PM</option>
                                                <option value="11:00 PM">11:00 PM</option>
                                                <option value="11:15 PM">11:15 PM</option>
                                                <option value="11:30 PM">11:30 PM</option>
                                                <option value="11:45 PM">11:45 PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="pickup_location" class="form-label">Pickup Location</label>
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
                                            <textarea name="note" class="form-control" id="note" cols="30" rows="5"
                                                value="{{ $rental->note }}"></textarea>
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
                                        @if (isset($rental->deposit->proof))
                                            <div class="col-4 d-flex align-items-end pt-2">
                                                <a class="btn btn-light" href="{{ asset($rental->payment->proof) }}"
                                                    target="_blank">View</a>
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
