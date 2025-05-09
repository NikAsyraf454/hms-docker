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
                        <h5 class="card-title">New Maintenance</h5>
                        @php
                            $userId = session('user_id');
                        @endphp
                        {{-- <form action="{{ route('maintenance.store') }}" method="POST">
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
                            <div id="formFields"></div>

                            <button type="button" class="btn btn-secondary mb-3" onclick="addField()">Add
                                Item</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form> --}}
                        <form action="{{ route('maintenance.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="fleet_id" value="{{ $id }}">
                            <div id="formFields">
                                <!-- Initial row without remove button -->
                                <div class="row mb-3 maintenance-item">
                                    <div class="col-md-4">
                                        <label for="maintenance_type">Maintenance Type</label>
                                        <select name="maintenance_type" class="form-control" required>
                                            @foreach ($type as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="odometer">Odometer</label>
                                        <input type="number" name="odometer" class="form-control" placeholder="Odometer"
                                            min="1" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cost">Cost</label>
                                        <input type="number" name="cost" class="form-control" placeholder="Cost"
                                            min="1" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" class="form-control" placeholder="Date"
                                            required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="notes">Notes</label>
                                        <input type="text" name="notes" class="form-control" placeholder="Notes"
                                            required>
                                    </div>
                                </div>
                            </div>

                            {{-- <button type="button" class="btn btn-secondary" onclick="addField()">Add Item</button> --}}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                {{-- Form template --}}
                {{-- <div class="container mt-4">
                    <h1>Create New Form</h1>

                    <div class="row mt-4">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <form id="formBuilder" action="{{ route('maintenance.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Form Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description"></textarea>
                                        </div>

                                        <div id="formFields"></div>

                                        <button type="button" class="btn btn-secondary mb-3" onclick="addField()">Add
                                            Field</button>
                                        <button type="submit" class="btn btn-primary">Save Form</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Preview</h5>
                                    <div id="formPreview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
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

    {{-- <script>
        function addField() {
            const formFields = document.getElementById('formFields');
            const newItem = document.querySelector('.maintenance-item').cloneNode(true);

            // Add remove button to the new item
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn btn-danger';
            removeBtn.innerText = 'Remove';
            removeBtn.onclick = function() {
                newItem.remove();
            };

            // Create a column for the remove button and append it to the new item
            const col = document.createElement('div');
            col.className = 'col-md-1 d-flex align-items-end';
            col.appendChild(removeBtn);
            newItem.appendChild(col);

            formFields.appendChild(newItem);
        }
    </script> --}}

    {{-- <script>
        let fieldCount = 0;

        function addField() {
            const fieldsContainer = document.getElementById('formFields');
            const fieldHtml = `
                <div class="card mb-3" id="field-${fieldCount}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6>Field ${fieldCount + 1}</h6>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeField(${fieldCount})">Remove</button>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Field Type</label>
                            <select class="form-control" name="fields[${fieldCount}][type]" onchange="toggleOptions(${fieldCount})" required>
                                <option value="text">Text</option>
                                <option value="textarea">Textarea</option>
                                <option value="number">Number</option>
                                <option value="email">Email</option>
                                <option value="select">Select</option>
                                <option value="radio">Radio</option>
                                <option value="checkbox">Checkbox</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Label</label>
                            <input type="text" class="form-control" name="fields[${fieldCount}][label]" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Field Name</label>
                            <input type="text" class="form-control" name="fields[${fieldCount}][name]" required>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="fields[${fieldCount}][required]" value="1">
                                <label class="form-check-label">Required</label>
                            </div>
                        </div>

                        <div class="mb-3 options-container" id="options-${fieldCount}" style="display: none;">
                            <label class="form-label">Options (one per line)</label>
                            <textarea class="form-control" name="fields[${fieldCount}][options]" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            `;

            fieldsContainer.insertAdjacentHTML('beforeend', fieldHtml);
            fieldCount++;
            updatePreview();
        }

        function removeField(index) {
            document.getElementById(`field-${index}`).remove();
            updatePreview();
        }

        function toggleOptions(index) {
            const fieldType = document.querySelector(`[name="fields[${index}][type]"]`).value;
            const optionsContainer = document.getElementById(`options-${index}`);

            if (['select', 'radio', 'checkbox'].includes(fieldType)) {
                optionsContainer.style.display = 'block';
            } else {
                optionsContainer.style.display = 'none';
            }
            updatePreview();
        }

        function updatePreview() {
            const preview = document.getElementById('formPreview');
            preview.innerHTML = '';

            document.querySelectorAll('#formFields .card').forEach(field => {
                const type = field.querySelector('[name*="[type]"]').value;
                const label = field.querySelector('[name*="[label]"]').value;
                const required = field.querySelector('[name*="[required]"]').checked;
                const options = field.querySelector('[name*="[options]"]')?.value;

                let fieldHtml = `
                    <div class="mb-3">
                        <label class="form-label">${label}${required ? ' *' : ''}</label>
                `;

                switch (type) {
                    case 'textarea':
                        fieldHtml += `<textarea class="form-control" ${required ? 'required' : ''}></textarea>`;
                        break;
                    case 'select':
                        fieldHtml += `<select class="form-control" ${required ? 'required' : ''}>`;
                        if (options) {
                            options.split('\n').forEach(option => {
                                fieldHtml += `<option>${option.trim()}</option>`;
                            });
                        }
                        fieldHtml += `</select>`;
                        break;
                    case 'radio':
                    case 'checkbox':
                        if (options) {
                            options.split('\n').forEach(option => {
                                fieldHtml += `
                                    <div class="form-check">
                                        <input type="${type}" class="form-check-input" ${required ? 'required' : ''}>
                                        <label class="form-check-label">${option.trim()}</label>
                                    </div>
                                `;
                            });
                        }
                        break;
                    default:
                        fieldHtml += `<input type="${type}" class="form-control" ${required ? 'required' : ''}>`;
                }

                fieldHtml += '</div>';
                preview.insertAdjacentHTML('beforeend', fieldHtml);
            });
        }

        document.getElementById('formBuilder').addEventListener('input', updatePreview);
    </script> --}}
@endsection
