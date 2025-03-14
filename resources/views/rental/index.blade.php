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
                    <h5 class="card-title">Rental</h5>
                    <a href="{{ route('rental.create') }}" class="btn btn-primary mb-3">New Rental</a>
                    <div class="table-responsive">
                        {{-- <div class="d-none d-md-block table-responsive"> --}}
                        <table id="tableData" class="datatable table">
                            <thead>
                                <tr>
                                    <th>Car</th>
                                    <th>Name</th>
                                    <th>Pickup</th>
                                    <th>Return</th>
                                    <th>Duration</th>
                                    <th>Payment</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rentals as $item)
                                    <tr>
                                        <td>{{ $item->fleet->license_plate }}</td>
                                        <td>{{ $item->customer->name }} <br>
                                            <div style="font-size: 12px">{{ $item->customer->phone }}</div>
                                        </td>
                                        <td>{{ date('d M Y', strtotime($item->pickup_date)) }} <br>
                                            {{ date('g:i A', strtotime($item->pickup_time)) }}</td>
                                        <td>{{ date('d M Y', strtotime($item->return_date)) }} <br>
                                            {{ date('g:i A', strtotime($item->return_time)) }}</td>
                                        <td>
                                            @php
                                                $pickup = \Carbon\Carbon::parse(
                                                    $item->pickup_date . ' ' . $item->pickup_time,
                                                );
                                                $return = \Carbon\Carbon::parse(
                                                    $item->return_date . ' ' . $item->return_time,
                                                );
                                                $duration = $pickup->diffInDays($return);
                                            @endphp
                                            @php
                                                $durationHours = $pickup->diffInHours($return);
                                                $days = floor($durationHours / 24);
                                                $hours = $durationHours % 24;
                                            @endphp
                                            @if ($days == 0)
                                                {{ $hours }} hours
                                            @else
                                                {{ $days }} @if ($days > 1)
                                                    days
                                                @else
                                                    day
                                                @endif
                                                {{ $hours }} hours
                                            @endif
                                        </td>
                                        <td>MYR {{ $item->payment->rental_amount }} <br>
                                            @if ($item->payment->payment_status == 'paid')
                                                <span class="badge bg-success">Paid</span>
                                            @elseif($item->payment->payment_status == 'unpaid')
                                                <span class="badge bg-danger">Unpaid</span>
                                            @else
                                                <span class="badge bg-warning">Partially Paid</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary" type="button" data-toggle="dropdown">
                                                    <i class="bi bi-grip-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('deposit.show', $item->depo_id) }}">Deposit</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('rental.show', $item->id) }}">Show</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('rental.edit', $item->id) }}">Edit</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('rental.destroy', $item->id) }}">Delete</a>
                                                </div>
                                            </div>
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

@section('script')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
@endsection
