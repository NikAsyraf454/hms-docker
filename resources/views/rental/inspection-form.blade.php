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
                        @php
                            $userId = session('user_id');
                        @endphp
                        <h5 class="card-title">Inspection Form</h5>
                        <form action="{{ route('rental.inspection.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="" name="staff_id" id="staff_id" value="{{ $userId }}">
                            <input type="hidden" class="" name="rental_id" id="rental_id"
                                value="{{ $id }}">
                            <div class="row">
                                <div class="col">
                                    <div class="col-md-12">
                                        <label for="text" class="form-label">Parts</label>
                                        <input type="text" class="form-control" name="parts" id="parts">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="mileage" class="form-label">Mileage</label>
                                        <input type="number" class="form-control" name="mileage" id="mileage">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="fuel" class="form-label">Fuel</label>
                                        <input type="text" class="form-control" name="fuel" id="fuel">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="remarks" class="form-label">Remarks</label>
                                        <input type="text" class="form-control" name="remarks" id="remarks">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="file">Image Front</label><br>
                                            <input type="file" class="form-control-file" id="img_front" name="img_front">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="file">Image Left</label><br>
                                            <input type="file" class="form-control-file" id="img_left" name="img_left">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="file">Image Right</label><br>
                                            <input type="file" class="form-control-file" id="img_right" name="img_right">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="file">Image Back</label><br>
                                            <input type="file" class="form-control-file" id="img_back" name="img_back">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="file">Additional Image 1</label><br>
                                            <input type="file" class="form-control-file" id="img_add1" name="img_add1">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="file">Additional Image 2</label><br>
                                            <input type="file" class="form-control-file" id="img_add2" name="img_add2">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="pt-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>

                            {{-- <input type="file" class="form-control" name="image[]" multiple /> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
