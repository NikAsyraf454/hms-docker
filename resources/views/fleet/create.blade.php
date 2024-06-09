<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title>Create Post</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand h1" href={{ route('claim.index') }}>CRUDclaim</a>
            <div class="justify-end ">
                <div class="col ">
                    <a class="btn btn-sm btn-success" href={{ route('fleet.create') }}>Add Fleet</a>
                </div>
            </div>
    </nav>

    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3>Add a fleet</h3>
                {{-- @dd($fleet) --}}
                @php
                    $userId = session('user_id');
                @endphp
                <form action="{{ route('fleet.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="" id="staff_id" name="staff_id" value="{{$userId}}">
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <select name="brand" id="brand">
                            <option value="Perodua">Perodua</option>
                            <option value="Proton">Proton</option>
                            <option value="Honda">Honda</option>
                            <option value="Toyota">Toyota</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" class="" id="model" name="model" required>
                    </div>
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="number" class="" id="year" name="year" required>
                    </div>
                    <div class="form-group">
                        <label for="license_plate">Plate Number</label>
                        <input type="text" class="" id="license_plate" name="license_plate" required>
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" class="" name="color" id="color" required>
                    </div>
                    <div class="form-group">
                        <label for="transmission"> Transmission</label>
                        <input type="text" class="" id="transmission" name="transmission" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" id="status" name="status" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Create Fleet</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>