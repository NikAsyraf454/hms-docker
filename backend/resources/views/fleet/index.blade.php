@extends('layouts.layout')

@section('content')
    <div class="row">
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
                <div class="row justify-content-center align-items-center">
                    <div class="col-8">
                        <div class="ratio ratio-4x3">
                            <iframe
                                src="https://calendar.google.com/calendar/embed?height=600&wkst=2&ctz=UTC&showPrint=0&title=Fleet%20Status&src=MjU1NmIzM2UxMjFiNTNmOTkzNTk4MmYzM2MwMGViYTMxMjkzNmFiOTZmOTJmZDlmODM3MjM5Nzk2N2FhYTFmMUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=MWE4MzlmNGIxNDI4N2NkYTJkNGYxNjhhYTM0N2E3MGMyMjkyNTViNjM0ODFlN2QxMDI0NWNlMmJhMjI0NzZmOUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=MWM4MmNjMDdiYWE2Y2U3YTI3MDI1NTU2ZjdjNmFjZTg5NWU4Yzk4ZDQ2ZjA1ODIyZDUwYWQ1ZTU4NzY2ZWE2MUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y2I0MWViOTVhNzlmZDY1ZGI2YTIxNDJlOGI5YzRmMTVkNGRmYzhhMDUwNDU1ODk2ODNmZTNmMmM5ZGY3NDNmNUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=YWE1ZWUxZjI5ZjAwZjI2Y2RjNzNkZDRkY2UyYzgwOGI4ZDU0NTM0Y2I0OTc2YzI5OTA1MGU1NTBhY2FlZGJmMEBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y2Q2YTVjZThiZTYxNzFiNmY0OWJhZTJkMTBkMzA0NTE2Y2RlNmVlNTA3YjZkMzA1ZTA2YTU3NzBkZmY1ODg1NUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=YjZkMzc0NjMyYmNmMGRlNDJkN2Q3MjVhOTZlMDY5ZGU2MzQ3MDIwMjAxMThlYmFhMzg0YWVmOWZiNDA5ZmEwZEBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=ZmExMjk1ZmQ0ZTQ1YmY4OTYyZWUzMjVjZDI5MzUxYTNhZGIyOGYxZDVlNmViNzY4NmQxZTkzZTA5YWNjNGY5NkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=ZmRhZjE3NDU0NTcxOGNkNTRhMGZkZmFlMzI2ZDBlMGVjODQ5YzE5OGMwMTNlYjRjNGE2MjhiNjA5OTlkZGRiMkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=ODE4OGRmY2Y5OWFmNzJkOTRiM2VhNmE3YmE5NTFmMGFkMjMxMDM3ZGMxZjUwNjQ1MDljOTlkZjVjZTEwYmFmMUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=OWMxM2U2OTlhMTUwMzBlNzliNWIwOThiMWQ3OGJlNzU3ZGI1NzM0M2ZiZjI3YTA4ZjcwMGY0ZTk1YWExYjliM0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%23795548&color=%23B39DDB&color=%23616161&color=%23009688&color=%237986CB&color=%23D50000&color=%23A79B8E&color=%23F09300&color=%23E67C73&color=%23F4511E&color=%233F51B5"
                                style="border:solid 1px #777" width="800" height="600" frameborder="0"
                                scrolling="no"></iframe>
                        </div>
                    </div>
                </div>
                <div class="card mt-2">
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
                                        {{-- <td>{{ $item->calendar }}</td> --}}
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary " type="button" id="dropdownMenuButton"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-grip-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    {{-- <a class="dropdown-item" href="fleet/view/{{ $item->id }}">View</a> --}}
                                                    <a class="dropdown-item"
                                                        href="{{ route('fleet.edit', $item->id) }}">View</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('fleet.destroy', $item->id) }}">Delete</a>
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
    <script>
        console.log('hoho')
    </script>
@endsection
