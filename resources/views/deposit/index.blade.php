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
                    <h5 class="card-title">Deposits</h5>
                    <div class="table-responsive">
                        <a href="{{ route('export.deposits') }}" class="btn btn-primary">Export</a>
                        <table id="tableData" class="datatable table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Pickup Date</th>
                                    <th>Customer</th>
                                    <th>Return Amount</th>
                                    <th>Status</th>
                                    <th>Remark</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deposit as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @if ($item->rentals)
                                            <td>
                                                {{ $item->rentals ? $item->rentals->fleet->license_plate : '-' }}
                                                <br>
                                                {{ $item->rentals->pickup_date }}
                                            </td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>
                                            <ul>
                                                <li>{{ $item->rentals->customer->acc_num_name ?? '-' }}</li>
                                                <li>{{ $item->rentals->customer->bank ?? '-' }}</li>
                                                <li>{{ $item->rentals->customer->acc_num ?? '-' }}</li>
                                            </ul>

                                        </td>
                                        <td>{{ $item->return_amount }}</td>

                                        <td>
                                            {{ $item->status }}
                                        </td>
                                        <td>{{ $item->remarks }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary" type="button" id="dropdownMenuButton"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-grip-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                        href="{{ route('deposit.show', $item->id) }}">Show</a>
                                                    <form action="{{ route('deposit.destroy', $item->id) }}" method="post"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">Delete</button>
                                                    </form>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <a href="{{ route('claim.create') }}" class="btn btn-primary">New Deposit</a> --}}


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
{{-- 
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tableData').DataTable();
        });
    </script>
@endpush --}}
