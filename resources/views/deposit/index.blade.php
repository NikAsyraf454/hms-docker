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
                                <th>Invoice No.</th>
                                <th>Status</th>
                                <th>Payment Date</th>
                                <th>Return Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // dd($deposit);
                            @endphp
                            @foreach ($deposit as $item)
                                {{-- @php
                                    dd($item->rentals);
                                @endphp --}}
                                <tr>
                                    @if ($item->rentals)
                                        <td>{{ $item->rentals->payment->invoice_id }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    <td>
                                        {{ $item->status }}
                                    </td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->return_date }}</td>
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
