@extends('layouts.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    {{-- @dd($fleet) --}}
                   
                        <h5 class="card-title">New Fleet</h5>
                        <!-- Vertical Form -->
                            @php
                                $userId = session('user_id');
                            @endphp
                            <form action="{{ route('fleet.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="" id="staff_id" name="staff_id" value="{{$userId}}">
                                    <div class="col-12">
                                            <label for="brand">Brand</label>
                                            <select name="brand" id="brand" class="form-select">
                                                <option value="Perodua">Perodua</option>
                                                <option value="Proton">Proton</option>
                                                <option value="Honda">Honda</option>
                                                <option value="Toyota">Toyota</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="model">Model</label>
                                            <input class="form-control" type="text" class="" id="model" name="model" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="year">Year</label>
                                            <input class="form-control" type="number" class="" id="year" name="year" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="license_plate">Plate Number</label>
                                            <input class="form-control" type="text" class="" id="license_plate" name="license_plate" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="color">Color</label>
                                            <input class="form-control" type="text" class="" name="color" id="color" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="transmission"> Transmission</label>
                                            <input class="form-control" type="text" class="" id="transmission" name="transmission" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <input class="form-control" type="text" id="status" name="status" required>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Create Fleet</button>
                            </form><!-- Vertical Form -->
                </div>
            </div>
        </div>
    </div>
    
</div>
    
@endsection

    
    

