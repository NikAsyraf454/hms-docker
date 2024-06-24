@extends('layouts.layout')

@section('content')
    <div class="row">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Fleet</h5>
                            <a href="{{ route('fleet.create') }}" class="btn btn-primary">New Fleet</a>

                                <table id="tableData" class="table datatable">
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

                </div>
            </div>
        </section>

    </div>
@endsection
@push('scripts')

@endpush
