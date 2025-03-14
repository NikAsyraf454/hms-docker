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
                    {{-- <a href="{{ route('claim.create') }}" class="btn btn-primary">New Deposit</a> --}}
                    <a href="{{ route('export.deposits') }}" class="btn btn-primary">Export</a>
                    <table id="tableData" class="datatable table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Invoice No.</th>
                                <th>Fleet</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Payment Date</th>
                                <th>Return Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deposit as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    @if ($item->rentals)
                                        <td>{{ $item->rentals->payment->invoice_id }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    <td>{{ $item->rentals ? $item->rentals->fleet->license_plate : '-' }}</td>
                                    <td>{{ $item->rentals->customer->name ?? '-' }}</td>

                                    <td>
                                        {{ $item->status }}
                                    </td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->return_date }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <a href="{{ route('deposit.show', $item->id) }}"
                                                    class="btn btn-primary btn-sm">Show</a>
                                            </div>
                                            <div class="col">
                                                <form action="{{ route('deposit.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
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
@endsection
{{-- 
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tableData').DataTable();
        });
    </script>
@endpush --}}
