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

                        <h5 class="card-title">New Rental Form</h5>
                        <!-- Vertical Form -->
                        @php
                            $userId = session('user_id');
                        @endphp
                        <form id="rentalForm" action="{{ route('rental.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" class="" id="staff_id" name="staff_id"
                                    value="{{ $userId }}">
                                <input type="hidden" class="" id="customer_id" name="customer_id" value="">
                                {{-- Customer Detail --}}
                                <div class="col-md-6">
                                    <h4>Customer Info</h4>
                                    <div class="col-12">
                                        <label for="name" class="form-label">Customer Name</label>
                                        <input type="text" placeholder="Customer Name" class="form-control"
                                            name="name" id="name" value="{{ old('name') }}">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" placeholder="email@gmail.com" class="form-control"
                                                name="email" id="email" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="race" class="form-label">Race / Nationality</label>
                                            <select class="form-control" name="race" id="race"
                                                value="{{ old('race') }}">
                                                <option value="Malay">Malay</option>
                                                <option value="China">China</option>
                                                <option value="India">India</option>
                                                <option value="Others">Others</option>
                                            </select>
                                            @error('race')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="ic" class="form-label">IC Number/Passport </label>
                                            <input type="number" placeholder="000000110000" class="form-control"
                                                name="ic" id="ic" value="{{ old('ic') }}">
                                            @error('ic')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="matric" class="form-label">Matric</label>
                                            <input type="text" placeholder="A24EC0021" class="form-control"
                                                name="matric" id="matric" value="{{ old('matric') }}">
                                            @error('matric')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label">Mobile Number </label>
                                            <input type="number" placeholder="0123456789" class="form-control"
                                                name="phone" id="phone" value="{{ old('phone') }}">
                                            @error('phone')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="college" class="form-label">College </label>
                                            <select class="form-control" name="college" id="college"
                                                value="{{ old('college') }}">
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
                                                <option value="KDOJ">Others</option>
                                            </select>
                                            @error('college')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="faculty" class="form-label">Faculty </label>
                                            <select class="form-control" name="faculty" id="faculty"
                                                value="{{ old('faculty') }}">
                                                <option value="FC">Civil Engineering</option>
                                                <option value="FM">Mechanical Engineering</option>
                                                <option value="FE">Electrical Engineering</option>
                                                <option value="FE">Chemical Engineering</option>
                                                <option value="FCS">Computing</option>
                                                <option value="FS">Science</option>
                                                <option value="FABU">FABU</option>
                                                <option value="FSSH">FSSH</option>
                                                <option value="Management">Management</option>
                                                <option value="AHIBS">AHIBS</option>
                                                <option value="MJIIT">MJIIT</option>
                                                <option value="SPACE">SPACE</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="address" class="form-label">Address </label>
                                            <input type="text" class="form-control" name="address" id="address"
                                                value="{{ old('address') }}">
                                            @error('address')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row pt-2">
                                        <h5>Bank Details</h5>
                                        <div class="col-md-6">
                                            <label for="bank" class="form-label">Bank</label>
                                            <select class="form-control" name="bank" id="bank"
                                                value="{{ old('bank') }}">
                                                <option value="Maybank">Maybank</option>
                                                <option value="Bank Islam">Bank Islam</option>
                                                <option value="Bank Rakyat">Bank Rakyat</option>
                                                <option value="Bank Muamalat">Bank Muamalat</option>
                                                <option value="Public Bank">Public Bank</option>
                                                <option value="RHB Bank">RHB Bank</option>
                                                <option value="Hong Leong">Hong Leong</option>
                                                <option value="Ambank">Ambank</option>
                                                <option value="CIMB Bank">CIMB Bank</option>
                                                <option value="Affin Bank">Affin Bank</option>
                                                <option value="UOB">UOB</option>
                                                <option value="OCBC">OCBC</option>
                                                <option value="Rize">Rize</option>
                                                <option value="GXBank">GXBank</option>
                                                <option value="TNG">TNG</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="acc_num" class="form-label"> Account Number</label>
                                            <input type="text" placeholder="" class="form-control" name="acc_num"
                                                id="acc_num" value="{{ old('acc_num') }}">
                                            @error('acc_num')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="acc_num_name" class="form-label"> Account Owner</label>
                                            <input type="text" placeholder="" class="form-control"
                                                name="acc_num_name" id="acc_num_name" value="{{ old('acc_num_name') }}">
                                            @error('acc_num_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- Rental Detail --}}
                                <div class="col-md-6">
                                    <h4>Rental Info</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="pickup_date" class="form-label">Pickup Date</label>
                                            <input type="date" class="form-control" name="pickup_date"
                                                id="pickup_date" value="{{ old('pickup_date') }}">
                                            @error('pickup_date')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="return_date" class="form-label">Return Date</label>
                                            <input type="date" class="form-control" name="return_date"
                                                id="return_date" value="{{ old('return_date') }}">
                                            @error('return_date')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @php
                                            // Generate times from 12:00 AM to 11:45 PM in 15-minute intervals
                                            $times = [];
                                            $startTime = strtotime('00:00'); // Start at midnight
                                            $endTime = strtotime('23:45'); // End at 11:45 PM
                                            while ($startTime <= $endTime) {
                                                $value = date('H:i', $startTime); // Value in 24-hour format
                                                $display = date('h:i A', $startTime); // Display in 12-hour format
                                                $times[] = ['value' => $value, 'display' => $display];
                                                $startTime = strtotime('+15 minutes', $startTime);
                                            }
                                        @endphp
                                        <div class="col-md-6">
                                            <label for="pickup_time" class="form-label">Pickup Time</label>
                                            {{-- <input type="time" class="form-control" id="pickup_time"
                                                name="pickup_time"> --}}
                                            <select class="form-select" name="pickup_time" required="required"
                                                id="pickup_time" value="{{ old('pickup_time') }}">
                                                @foreach ($times as $time)
                                                    <option value="{{ $time['value'] }}" {{ $time['value'] == '09:00' ? 'selected' : '' }}>
                                                        {{ $time['display'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="return_time" class="form-label">Return Time</label>
                                            {{-- <input type="time" class="form-control" id="return_time"
                                                name="return_time"> --}}
                                            <select class="form-select" name="return_time" required="required"
                                                id="return_time" value="{{ old('return_time') }}">
                                                @foreach ($times as $time)
                                                    <option value="{{ $time['value'] }}" {{ $time['value'] == '09:00' ? 'selected' : '' }}>
                                                        {{ $time['display'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="fleet_id" class="form-label">Plate Number</label>
                                            <select class="form-control" name="fleet_id" id="fleet_id" value="">
                                                <option value="">-- Select a Vehicle --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="pickup_location" class="form-label">Pickup Location</label>
                                            <input type="text" class="form-control" name="pickup_location"
                                                id="pickup_location" value="{{ old('pickup_location') }}">
                                            @error('pickup_location')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="return_location" class="form-label">Return Location</label>
                                            <input type="text" class="form-control" name="return_location"
                                                id="return_location" value="{{ old('return_location') }}">
                                            @error('return_location')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="note" class="form-label">Note</label>
                                            <textarea name="note" class="form-control" id="note" cols="30" rows="5"
                                                value="{{ old('note') }}"></textarea>
                                            @error('note')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="destination" class="form-label">Destination</label>
                                            <input type="text" class="form-control" name="destination"
                                                id="destination" value="{{ old('destination') }}">
                                            @error('destination')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <h5>Payment Details</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="rental_amount" class="form-label">Rental Amount</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">RM</span>
                                                    <input type="number" name="rental_amount" id="rental_amount"
                                                        class="form-control" placeholder="Rental Amount"
                                                        aria-label="Rental Amount" aria-describedby="basic-addon1"
                                                        value="{{ old('rental_amount') }}" required>
                                                </div>
                                                @error('rental_amount')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="payment_date" class="form-label">Payment Date</label>
                                                <input type="date" class="form-control" name="payment_date"
                                                    id="payment_date" value="{{ old('payment_date') }}">
                                                @error('payment_date')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="payment_status" class="form-label">Payment Status</label>
                                                <select class="form-control" name="payment_status" id="payment_status">
                                                    <option value="unpaid">Unpaid</option>
                                                    <option value="paid">Paid</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="payment_method" class="form-label">Payment Method</label>
                                                <select class="form-control" name="payment_method" id="payment_method">
                                                    <option value="Cash">Cash</option>
                                                    <option value="Transfer">Transfer</option>
                                                    <option value="QR">QR</option>
                                                </select>
                                            </div>
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
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="depo_amount" class="form-label">Depo Amount</label>
                                                <input type="number" class="form-control" name="depo_amount"
                                                    id="depo_amount" value="{{ old('depo_amount') }}">
                                                @error('depo_amount')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="depo_date" class="form-label">Depo Date</label>
                                                <input type="date" class="form-control" name="depo_date"
                                                    id="depo_date" value="{{ old('depo_date') }}">
                                                @error('depo_date')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="depo_status" class="form-label">Deposit Status</label>
                                                <select class="form-control" name="depo_status" id="depo_status">
                                                    <option value="Unpaid">Unpaid</option>
                                                    <option value="Paid">Paid</option>
                                                </select>
                                                @error('depo_status')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="inputNumber" class="col-sm col-form-label">Deposit
                                                    Proof</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="deposit_proof" id="deposit_proof"
                                                        type="file" id="formFile">
                                                </div>
                                                @error('deposit_proof')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Rental Detail --}}
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script>
        $(document).ready(function() {
            $('#name').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('customers.autocomplete') }}",
                        dataType: 'json',
                        data: {
                            query: request.term
                        },
                        success: function(data) {
                            console.log(data);
                            response($.map(data, function(item) {
                                return {
                                    label: item.name + ' (' + item.matric + ')',
                                    value: item.name,
                                    id: item.id,
                                    email: item.email,
                                    ic: item.ic,
                                    matric: item.matric,
                                    phone: item.phone,
                                    college: item.college,
                                    faculty: item.faculty,
                                    address: item.address,
                                    bank: item.bank,
                                    acc_num: item.acc_num,
                                    acc_num_name: item.acc_num_name,
                                };
                            }));
                        }
                    });
                },
                select: function(event, ui) {
                    //set values to input
                    $('#name').val(ui.item.value);
                    $('#customer_id').val(ui.item.id);
                    // $('#ic').val(ui.item.ic);
                    $('#ic').val(Number(ui.item.ic));
                    $('#matric').val(ui.item.matric);
                    $('#email').val(ui.item.email);
                    $('#phone').val(ui.item.phone);
                    $('#college').val(ui.item.college);
                    $('#faculty').val(ui.item.faculty);
                    $('#address').val(ui.item.address);
                    $('#bank').val(ui.item.bank);
                    $('#acc_num_name').val(ui.item.acc_num_name);
                    $('#acc_num').val(ui.item.acc_num);
                    return false;
                },
                minLength: 2,
            });
        });
    </script>
    <script>
        let debounceTimer;
        $('#rentalForm').on('change', '#pickup_date, #pickup_time, #return_date, #return_time', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function() {
                const pickupDate = $('#pickup_date').val();
                const pickupTime = $('#pickup_time').val();
                const returnDate = $('#return_date').val();
                const returnTime = $('#return_time').val();

                if (pickupDate && pickupTime && returnDate && returnTime) {
                    $.ajax({
                        url: '/available-vehicles',
                        method: 'GET',
                        data: {
                            pickup_date: pickupDate,
                            pickup_time: pickupTime,
                            return_date: returnDate,
                            return_time: returnTime
                        },
                        success: function(response) {
                            $('#fleet_id').empty();
                            $('#fleet_id').append('<option value="">-- Select a Vehicle --</option>');
                            $.each(response, function(id, licensePlate) {
                                $('#fleet_id').append(`<option value="${id}">${licensePlate}</option>`);
                            });
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            }, 300); // 300ms debounce delay
        });
    </script>
    <script>
        console.log('hehe');
    </script>
@endsection
