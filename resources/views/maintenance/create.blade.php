@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        {{-- @dd($fleet) --}}

                        <h5 class="card-title">New Maintenance</h5>
                        <!-- Vertical Form -->
                        @php
                            $userId = session('user_id');
                        @endphp
                        <form action="{{ route('maintenance.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="fleet_id" value="{{ $id }}">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="brand">Odometer</label>
                                    <input type="number" name="odometer" class="form-control" placeholder="Odometer"
                                        min="1" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="brand">Cost</label>
                                    <input type="number" name="cost" class="form-control" placeholder="Cost"
                                        min="1" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="brand">Date</label>
                                    <input type="date" name="date" class="form-control" placeholder="Date" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="brand">Notes</label>
                                    <input type="text" name="notes" class="form-control" placeholder="Notes" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="brand">Maintenance Type</label>
                                    <select name="maintenance_type" id="" class="form-control" required>
                                        @foreach ($type as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        console.log('hehe');
    </script>
@endsection
