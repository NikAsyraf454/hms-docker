@extends('layouts.layout')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sales For {{ $fleet->model }} {{ $fleet->license_plate }}</h5>
                    <div class="table-responsive">
                        {{-- <div class="d-none d-md-block table-responsive"> --}}
                        <table id="tableData" class="datatable table table-striped">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Pickup Date</th>
                                    <th>Rental Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($sales_by_month) --}}
                                @foreach ($rentals as $rental)
                                    <tr>
                                        <td>{{ $rental['customer_name'] }}</td>
                                        <td>{{ $rental['pickup_date'] }} <br>
                                            {{ $rental['pickup_time'] }}</td>
                                        </td>
                                        <td>RM {{ number_format($rental['rental_amount'], 2) }}</td>
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
