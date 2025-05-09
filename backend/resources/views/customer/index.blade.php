@extends('layouts.layout')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
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
                                    <th>No.</th>
                                    {{-- <th>ID</th> --}}
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
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td>{{ $item->id }}</td> --}}
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->matric }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary " type="button" id="dropdownMenuButton"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-grip-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    {{-- <a class="dropdown-item" href="fleet/view/{{ $item->id }}">View</a> --}}
                                                    <a class="dropdown-item"
                                                        href="{{ route('customer.show', $item->id) }}">View</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('customer.edit', $item->id) }}">Edit</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('customer.destroy', $item->id) }}">Delete</a>
                                                </div>
                                            </div>
                                            {{-- <div class="row">
                                                <div class="col">
                                                    <a href="{{ route('customer.show', $item->id) }}"
                                                        class="btn btn-primary btn-sm">Show</a>
                                                </div>
                                                <div class="col">
                                                    <a href="{{ route('customer.show', $item->id) }}"
                                                    class="btn btn-primary btn-sm">Show</a>
                                                </div>
                                                <div class="col">
                                                    <form action="{{ route('customer.destroy', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </div>
                                            </div> --}}
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
