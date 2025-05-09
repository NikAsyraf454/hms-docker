@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        {{-- @dd($fleet) --}}

                        <h5 class="card-title">New User</h5>
                        <!-- Vertical Form -->
                        @php
                            $userId = session('user_id');
                        @endphp
                        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="" id="staff_id" name="staff_id" value="{{ $userId }}">
                            <div class="col-12">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-select">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" id="name" name="name" required>
                            </div>
                            <div class="col-12">
                                <label for="email">Email</label>
                                <input class="form-control" type="text" id="email" name="email" required>
                            </div>
                            <div class="col-12">
                                <label for="password">Password</label>
                                <input class="form-control" type="text" id="password" name="password" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Create User</button>
                        </form><!-- Vertical Form -->
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
