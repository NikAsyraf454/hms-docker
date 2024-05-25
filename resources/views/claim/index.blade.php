<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>CRUDPosts</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand h1" href={{ route('claim.index') }}>CRUDclaim</a>
            <div class="justify-end ">
                <div class="col ">
                    <a class="btn btn-sm btn-success" href={{ route('claim.create') }}>Add Post</a>
                </div>
            </div>
    </nav>
    <div class="container mt-5">
        <div class="row">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            
                <table id="tableData" class="table table-striped">
                    <thead>
                        <tr>
                        {{-- <th scope="col">#</th> --}}
                        <th scope="col">Plate Number</th>
                        <th scope="col">Details</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($claims as $item)
                            <tr>
                                {{-- <th scope="row">{{$loop->index+1}}</th> --}}
                                <td>{{ $item->plate_number }}</td>
                                <td>{{ $item->details }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                        <a href="{{ route('claim.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        </div>
                                        <div class="col">
                                            <form action="{{ route('claim.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ $post->details }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $post->plate_number }}</p>
                            <p class="card-text">{{ $post->amount }}</p>
                            <img src="{{ asset($post->receipt) }}" alt="{{ $post->details }}">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm">
                                    <a href="{{ route('claim.edit', $post->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                </div>
                                <div class="col-sm">
                                    <form action="{{ route('claim.destroy', $post->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
        </div>
    </div>
    {{-- @push('js')
        <script>
            $(document).ready(function() {
                $('#tableData').DataTable();
            });
        </script>
    @endpush --}}
</body>

</html>

