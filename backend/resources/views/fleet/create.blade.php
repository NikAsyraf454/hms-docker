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
                            <input type="hidden" class="" id="staff_id" name="staff_id" value="{{ $userId }}">
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
                                <select name="model" id="model" class="form-select">
                                    <option value="Axia">Axia</option>
                                    <option value="Axia (2nd Gen)">Axia (2nd Gen)</option>
                                    <option value="Myvi (2nd Gen)">Myvi (2nd Gen)</option>
                                    <option value="Myvi (3rd Gen)">Myvi (3rd Gen)</option>
                                    <option value="Bezza">Bezza</option>
                                    <option value="Bezza (2nd Gen)">Bezza (2nd Gen)</option>
                                    <option value="Alza">Alza</option>
                                    <option value="Alza (2nd Gen)">Alza (2nd Gen)</option>
                                    <option value="Iriz">Iriz</option>
                                    <option value="Saga">Saga</option>
                                    <option value="Persona">Persona</option>
                                    <option value="X70">X70</option>
                                    <option value="X50">X50</option>
                                    <option value="City">City</option>
                                    <option value="Civic">Civic</option>
                                    <option value="Vios">Vios</option>
                                    <option value="Yaris">Yaris</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="year">Year</label>
                                <input class="form-control" type="number" id="year" name="year" min="2000"
                                    max="2030" step="1" value="{{ date('Y') }}" required>
                            </div>
                            <div class="col-12">
                                <label for="license_plate">Plate Number</label>
                                <input class="form-control" type="text" class="" id="license_plate"
                                    name="license_plate" required>
                            </div>
                            <div class="col-12">
                                <label for="color">Color</label>
                                <input class="form-control" type="text" class="" name="color" id="color"
                                    required>
                            </div>
                            <div class="col-12">
                                <label for="transmission"> Transmission</label>
                                <select class="form-control" name="transmission" id="transmission">
                                    <option value="Auto">Auto</option>
                                    <option value="Manual">Manual</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Available</option>
                                    <option value="0">Unavailable</option>
                                </select>
                                {{-- <input class="form-control" type="text" id="status" name="status" required> --}}
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
