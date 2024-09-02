@extends('layouts.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="row h-100 justify-content-center align-items-center"> --}}
                    {{-- <div class="col-10 col-md-8 col-lg-6"> --}}
                    <h5 class="card-title">Fleet Details</h5>
                    <form action="{{ route('fleet.update', $fleet->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="brand">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand"
                                value="{{ $fleet->brand }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="model">Model</label>
                            <input type="text" class="form-control" id="model" name="model"
                                value="{{ $fleet->model }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="year">Year</label>
                            <input type="text" class="form-control" id="year" name="year"
                                value="{{ $fleet->year }}" required>
                        </div>
                        <div class="col-md-6">
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

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Maintenance</h5>
                    <a href="{{ route('maintenance.create', $fleet->id) }}" class="btn btn-primary">Maintenance</a>
                    <div class="table-responsive">
                        <table id="tableData" class="datatable table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Odometer</th>
                                    <th>Cost</th>
                                    <th>Notes</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($maintenance as $item)
                                    {{-- @dd($item->maintenanceType->name) --}}
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->maintenanceType->name }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->odometer_reading }}</td>
                                        <td>RM {{ $item->cost }}</td>
                                        <td>{{ $item->notes }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <a href="{{ route('maintenance.show', $item->id) }}"
                                                        class="btn btn-primary btn-sm">Show</a>
                                                </div>
                                                <div class="col">
                                                    <form action="{{ route('maintenance.destroy', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
