@extends('layouts.layout')

@section('content')
    <div class="row">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
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
                                @foreach ($fleets as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->model }}</td>
                                        <td>{{ $item->license_plate }}</td>
                                        <td>
                                            <div class="btn-group">
                                                {{-- <a type="button" href="{{ route('fleet.show', $item->id) }}"
                                                        class="btn btn-primary"><i class="bi bi-pencil-square"></i></a> --}}
                                                <a type="button" href="{{ route('fleet.edit', $item->id) }}"
                                                    class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                <a type="button" href="{{ route('fleet.destroy', $item->id) }}"
                                                    class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
    <script>
        console.log('hehe')
    </script>
@endsection
