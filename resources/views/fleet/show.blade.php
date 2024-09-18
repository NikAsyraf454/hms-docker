@extends('layouts.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="row h-100 justify-content-center align-items-center"> --}}
                    {{-- <div class="col-10 col-md-8 col-lg-6"> --}}
                    <h5 class="card-title">View Fleet</h5>
                    <div class="col-12">
                        <label for="name">Brand</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $fleet->brand }}"
                            required readonly>
                    </div>
                    <div class="col-12">
                        <label for="email">Model</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $fleet->model }}"
                            required readonly>
                    </div>
                    <div class="col-12">
                        <label for="email">Year</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $fleet->year }}"
                            required readonly>
                    </div>
                    <div class="col-12">
                        <label for="email">License Plate</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ $fleet->license_plate }}" required readonly>
                    </div>
                    <div class="col-12">
                        <label for="email">Color</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $fleet->color }}"
                            required readonly>
                    </div>
                    <div class="pt-2">
                        <a href="{{ route('fleet.edit', $fleet->id) }}" class="btn btn-primary">Update User</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
