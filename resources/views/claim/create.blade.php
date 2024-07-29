@extends('layouts.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
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
                   
                        <h5 class="card-title">New Claim Form</h5>
                        <!-- Vertical Form -->
                            @php
                                $userId = session('user_id');
                            @endphp
                    <form action="{{ route('claim.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="" id="staff_id" name="staff_id" value="{{$userId}}">
                        <div class="col-12">
                        <label for="details" class="form-label">Claim Detail</label>
                        <input type="text" class="form-control" name="details" id="details">
                        </div>
                        <div class="col-12">
                        <label for="plate_number" class="form-label">Plate</label>
                        <select class="form-control" name="plate_number" id="plate_number">
                            @foreach ($fleet as $car)
                                <option value="{{$car->license_plate}}">{{$car->license_plate}}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" class="form-control" name="plate_number" id="plate_number" > --}}
                        </div>
                        <div class="col-12">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" id="date" >
                        </div>
                        <div class="col-12">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" id="amount" >
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="file">Proof Receipt</label><br>
                            <input type="file" class="form-control-file" id="receipt" name="receipt" required>
                        </div>
                        <div class="pt-2">
                        <button type="submit" class="btn btn-primary">Submit Claim</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- Vertical Form -->
                    
                </div>
            </div>
        </div>
    </div>
    
</div>
    
@endsection
@section('script')
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
        <script>
        $( function() {
            // $( "#date" ).datepicker();
            $('#date').datepicker({ dateFormat: 'yy-mm-dd' }).val();
        } );
        </script>
@endsection