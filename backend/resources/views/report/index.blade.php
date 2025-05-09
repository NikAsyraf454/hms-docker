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
                    <h5 class="card-title">Sales By Month</h5>
                    <div class="table-responsive">
                        {{-- <div class="d-none d-md-block table-responsive"> --}}
                        <table id="tableData" class="datatable table table-striped">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($sales_by_month) --}}
                                @foreach ($sales_by_month as $item)
                                    {{-- @dd($item) --}}
                                    <tr>
                                        <td>{{ $item->month }}</td>
                                        <td>RM {{ $item->total }}
                                        </td>
                                        {{-- <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary" type="button" data-toggle="dropdown">
                                                    <i class="bi bi-grip-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('deposit.show', $item->depo_id) }}">Deposit</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('rental.show', $item->id) }}">Show</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('rental.edit', $item->id) }}">Edit</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('rental.destroy', $item->id) }}">Delete</a>
                                                </div>
                                            </div>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sales By Car {{ \Carbon\Carbon::now()->year }}</h5>
                    <div class="table-responsive">
                        {{-- <div class="d-none d-md-block table-responsive"> --}}
                        <table id="tableData" class="datatable table table-striped">
                            <thead>
                                <tr>
                                    <th>Fleet</th>
                                    <th>Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($sales_by_month) --}}
                                @foreach ($sales_by_car as $item)
                                    <tr>
                                        <td><a href="{{ route('report.byfleet', $item->id) }}">{{ $item->model }}
                                                {{ $item->license_plate }}</a></td>
                                        <td>RM {{ $item->total }}
                                        </td>
                                        {{-- <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary" type="button" data-toggle="dropdown">
                                                    <i class="bi bi-grip-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('deposit.show', $item->depo_id) }}">Deposit</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('rental.show', $item->id) }}">Show</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('rental.edit', $item->id) }}">Edit</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('rental.destroy', $item->id) }}">Delete</a>
                                                </div>
                                            </div>
                                        </td> --}}
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
