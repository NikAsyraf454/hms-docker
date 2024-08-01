@extends('layouts.layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Claim Details</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Vertical Form -->
            @if ($category == 'members')
                @include('components.claim.member')
            @elseif($category == 'extra')
                @include('components.claim.extra')
            @elseif($category == 'depo')
                @include('components.claim.depo')
            @elseif($category == 'claims')
                @include('components.claim.claims')  
            @endif
        </div>
    </div>

@endsection

@push('js')
        <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
      </script>
    <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js">
      </script>
@endpush
