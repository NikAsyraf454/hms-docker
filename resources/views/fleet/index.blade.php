@extends('layouts.layout')
@section('content')
    <div class="container mt-5">
            <a href="{{route('fleet.create')}}" class="btn btn-primary">Create New</a>
        <div class="row">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            <table id="tableData" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Model</th>
                <th>Plate</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fleets as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->model }}</td>
                <td>{{ $item->license_plate }}</td>
                <td>
                      <div class="row">
                        <div class="col">
                        <a href="{{ route('fleet.edit', $item->id) }}"
                            class="btn btn-primary btn-sm">Edit</a>
                        </div>
                        <div class="col">
                            <form action="{{ route('fleet.destroy', $item->id) }}" method="post">
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
   
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#tableData').DataTable();
    });
</script>
@endpush
