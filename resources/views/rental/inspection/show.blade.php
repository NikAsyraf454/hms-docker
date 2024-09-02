@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @php
                            $userId = session('user_id');
                        @endphp
                        <h5 class="card-title">{{ ucfirst($type) }} Inspection Form</h5>
                        {{-- <form action="{{ route('inspection.store') }}" method="post" enctype="multipart/form-data"> --}}
                        {{-- @csrf --}}
                        <input type="hidden" class="" name="staff_id" id="staff_id" value="{{ $userId }}">
                        <input type="hidden" class="" name="rental_id" id="rental_id" value="{{ $id }}">
                        <div class="row">
                            <div class="col">
                                <div class="col-md-12">
                                    <label for="text" class="form-label">Parts</label>
                                    @php
                                        // Decode the JSON string to an array
                                        $selectedParts = json_decode($inspection->parts, true);
                                    @endphp

                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="parts[]" id="parts[]"
                                                value="Power Outlet"
                                                {{ in_array('Power Outlet', $selectedParts) ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="parts[]">
                                                Power Outlet
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="parts[]" id="parts[]"
                                                value="Infotainment System"
                                                {{ in_array('Infotainment System', $selectedParts) ? 'checked' : '' }}
                                                disabled>
                                            <label class="form-check-label" for="parts[]">
                                                Infotainment System
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="parts[]" id="parts[]"
                                                value="Carpet" {{ in_array('Carpet', $selectedParts) ? 'checked' : '' }}
                                                disabled>
                                            <label class="form-check-label" for="parts[]">
                                                Carpet
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="parts[]" id="parts[]"
                                                value="Spare Tyre"
                                                {{ in_array('Spare Tyre', $selectedParts) ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="parts[]">
                                                Spare Tyre
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="parts[]" id="parts[]"
                                                value="Car Toolkit"
                                                {{ in_array('Car Toolkit', $selectedParts) ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="parts[]">
                                                Car Toolkit
                                            </label>
                                        </div>
                                    </div>

                                    {{-- <input type="text" class="form-control" name="parts" id="parts"> --}}
                                </div>
                                <div class="col-md-12">
                                    <label for="mileage" class="form-label">Mileage</label>
                                    {{-- <input type="number" class="form-control" name="mileage" id="mileage"
                                            value="{{ $inspection->mileage }}"> --}}
                                    <div class="input-group mb-3">
                                        <input type="number" name="mileage" class="form-control" placeholder="Mileage"
                                            aria-label="Mileage" aria-describedby="basic-addon2"
                                            value="{{ $inspection->mileage }}" readonly>
                                        <span class="input-group-text" id="basic-addon2">KM</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <label for="fuel" class="form-label">Fuel</label>

                                        <div class="col fw-bold">
                                            <span id="demo">0 </span> Bar
                                        </div>
                                        <div class="col">
                                            <input type="range" name="fuel" id="fuel" class="form-range"
                                                min="0" max="8" step="1"
                                                value="{{ $inspection->fuel }}" disabled>
                                        </div>
                                    </div>


                                    {{-- <input type="text" class="form-control" name="fuel" id="fuel"> --}}
                                </div>
                                <div class="col-md-12">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <input type="text" class="form-control" name="remarks" id="remarks" readonly>
                                </div>
                            </div>
                            <div class="col">
                                @php
                                    $gambar = json_decode($inspection->image);
                                @endphp
                                {{-- @dd($gambar->front --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="file">Image Front</label><br>
                                        <img src="{{ asset($gambar->front) }}" alt="" width="50%"
                                            data-bs-toggle="modal" data-bs-target="#imageModal" class="enlarge-image">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="file">Image Left</label><br>
                                        <img src="{{ asset($gambar->left) }}" alt="" width="50%"
                                            data-bs-toggle="modal" data-bs-target="#imageModal" class="enlarge-image">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="file">Image Right</label><br>
                                        <img src="{{ asset($gambar->right) }}" alt="" width="50%"
                                            data-bs-toggle="modal" data-bs-target="#imageModal" class="enlarge-image">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="file">Image Back</label><br>
                                        <img src="{{ asset($gambar->back) }}" alt="" width="50%"
                                            data-bs-toggle="modal" data-bs-target="#imageModal" class="enlarge-image">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="file">Additional Image 1</label><br>

                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="file">Additional Image 2</label><br>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="pt-2">
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                        </div>

                        {{-- <input type="file" class="form-control" name="image[]" multiple /> --}}
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" alt="" id="modalImage" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        var slider = document.getElementById("fuel");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value; // Display the default slider value

        // Update the current slider value (each time you drag the slider handle)
        slider.oninput = function() {
            output.innerHTML = this.value;
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.enlarge-image');
            const modalImage = document.getElementById('modalImage');

            images.forEach(image => {
                image.addEventListener('click', function() {
                    modalImage.src = this.src;
                    modalImage.alt = this.alt;
                });
            });
        });
    </script>
@endsection
