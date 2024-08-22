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
                    <a href="{{ route('rental.create') }}" class="btn btn-primary">New Rental</a>
                    <div class="table-responsive">
                        <table id="tableData" class="datatable table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Car</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Pickup</th>
                                    <th>Return</th>
                                    <th>Amount (RM)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rentals as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->fleet->license_plate }}</td>
                                        <td>{{ $item->customer->name }}</td>
                                        <td>{{ $item->customer->phone }}</td>
                                        <td>{{ $item->pickup_date }} <br> {{ $item->pickup_time }}</td>
                                        <td>{{ $item->return_date }} <br> {{ $item->return_time }}</td>
                                        <td>{{ $item->payment->rental_amount }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <a href="{{ route('rental.edit', $item->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                </div>
                                                <div class="col">
                                                    <a href="{{ route('rental.show', $item->id) }}"
                                                        class="btn btn-primary btn-sm">Show</a>
                                                </div>
                                                <div class="col">
                                                    <form action="{{ route('rental.destroy', $item->id) }}" method="post">
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

@push('scripts')
    {{-- <script>
    $(document).ready(function() {
        $('#tableData').DataTable();
    });
</script> --}}
@endpush
