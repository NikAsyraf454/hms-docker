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
                    <h5 class="card-title">Customer</h5>
                    {{-- <a href="{{ route('rental.create') }}" class="btn btn-primary">New Rental</a> --}}
                    <div class="table-responsive">
                        <table id="tableData" class="datatable table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Matric</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->matric }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <a href="{{ route('customer.show', $item->id) }}"
                                                        class="btn btn-primary btn-sm">Show</a>
                                                </div>
                                                <div class="col">
                                                    {{-- <a href="{{ route('customer.show', $item->id) }}"
                                                    class="btn btn-primary btn-sm">Show</a> --}}
                                                </div>
                                                <div class="col">
                                                    <form action="{{ route('customer.destroy', $item->id) }}"
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

@push('scripts')
    {{-- <script>
    $(document).ready(function() {
        $('#tableData').DataTable();
    });
</script> --}}
@endpush
