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
                        <table id="tableData" class="datatable table">
                            <thead>
                                <tr>
                                    {{-- <th>No.</th> --}}
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
                                        {{-- <td>{{ $loop->iteration }}</td> --}}
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
                                            {{-- {{ $item->status }} --}}
                                            @if ($item->status == 'Paid')
                                                <span class="badge bg-success">Paid</span>
                                            @elseif($item->status == 'Unpaid')
                                                <span class="badge bg-danger">Unpaid</span>
                                            @endif
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
    <!-- Include jQuery DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
@endsection
