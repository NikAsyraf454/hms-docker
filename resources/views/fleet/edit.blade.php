@extends('layouts.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                        {{-- <div class="row h-100 justify-content-center align-items-center"> --}}
                            {{-- <div class="col-10 col-md-8 col-lg-6"> --}}
                                <h5 class="card-title">Edit Fleet</h5>
                                <form action="{{ route('fleet.update', $fleet->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-12">
                                        <label for="brand">Brand</label>
                                        <input type="text" class="form-control" id="brand" name="brand"
                                            value="{{ $fleet->brand }}" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="model">Model</label>
                                        <input type="text" class="form-control" id="model" name="model"
                                            value="{{ $fleet->model }}" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="year">Year</label>
                                        <input type="text" class="form-control" id="year" name="year"
                                            value="{{ $fleet->year }}" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="plate_number">Plate number</label>
                                        <input type="text" class="form-control" id="license_plate" name="plate_number"
                                            value="{{ $fleet->license_plate }}">

                                    </div>
                                    <div class="pt-2">
                                        <button type="submit" class="btn btn-primary">Update Fleet</button>
                                    </div>
                                </form>
                            {{-- </div> --}}
                        {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
        
@endsection
