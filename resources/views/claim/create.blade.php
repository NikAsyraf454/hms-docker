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
                    <a class="btn btn-sm btn-success" href={{ route('claim.create') }}>Add Post</a>
                </div>
            </div>
    </nav>

    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3>Add a claim</h3>
                {{-- @dd($fleet) --}}
                @php
                    $userId = session('user_id');
                @endphp
                <form action="{{ route('claim.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="" id="staff_id" name="staff_id" value="{{$userId}}">
                    <div class="form-group">
                        <label for="details">Details</label>
                        <input type="text" class="form-control" id="details" name="details" required>
                    </div>
                    <div class="form-group">
                        <label for="details">Broker</label>
                        <select name="broker" id="broker">
                            <option value="Hasta">Hasta</option>
                            <option value="Sinergi">Sinergi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="details">Plate Number</label>
                        <select name="plate_number" id="plate_number">
                            @foreach ($fleet as $car)
                                <option value="{{$car->license_plate}}">{{$car->license_plate}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="" name="date" id="date">
                    </div>
                    <div class="form-group">
                        <label for="amount">Claim Amount (RM)</label>
                        <input type="number" class="" id="amount" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="file">Proof Receipt</label>
                        <input type="file" class="form-control-file" id="receipt" name="receipt" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Create Post</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>