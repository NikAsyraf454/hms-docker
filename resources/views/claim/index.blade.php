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
                            <h5 class="card-title">Claims</h5>
                            <a href="{{ route('claim.create') }}" class="btn btn-primary">New Claim</a>

                            <table id="tableData" class="datatable table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Staff</th>
                                        <th>Details</th>
                                        <th>Plate Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($claims as $item)
                                        <tr>
                                            <td>{{ $item->claim_id }}</td>
                                            <td>{{ $item->user_name }}</td>
                                            <td>{{ $item->details }}</td>
                                            <td>{{ $item->plate_number }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <a href="{{ route('claim.edit', $item->claim_id) }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                     <div class="col">
                                                        <a href="{{ route('claim.show', $item->claim_id) }}"
                                                            class="btn btn-primary btn-sm">Show</a>
                                                    </div>
                                                    <div class="col">
                                                        <form action="{{ route('claim.destroy', $item->claim_id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Delete</button>
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
    {{-- <script>
    $(document).ready(function() {
        $('#tableData').DataTable();
    });
</script> --}}
@endpush
