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
                    <h5 class="card-title">Claims</h5>
                    <a href="{{ route('claim.create') }}" class="btn btn-primary">New Deposit</a>
                    <a href="{{ route('deposit.export') }}" class="btn btn-primary">Export</a>

                    <table id="tableData" class="datatable table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Payment Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // dd($claims)
                            @endphp
                            @foreach ($deposit as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td></td>
                                    <td>

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

@push('scripts')
    {{-- <script>
    $(document).ready(function() {
        $('#tableData').DataTable();
    });
</script> --}}
@endpush
