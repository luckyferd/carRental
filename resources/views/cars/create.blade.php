@extends('layouts.car')

@section('content')
<div class="container">
    <h1>Add New Car</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="cars_name" class="form-label">Car Name</label>
            <input type="text" name="cars_name" class="form-control" id="cars_name" value="{{ old('cars_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="car_type" class="form-label">Car Type</label>
            <select name="car_type" class="form-control" id="car_type" required>
                <option value="">Select Car Type</option>
                @foreach($carTypes as $type)
                    <option value="{{ $type->type_id }}" {{ old('car_type') == $type->type_id ? 'selected' : '' }}>
                        {{ $type->type_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="car_status" class="form-label">Car Status</label>
            <select name="car_status" class="form-control" id="car_status" required>
                <option value="ready" {{ old('car_status') == 'ready' ? 'selected' : '' }}>Ready</option>
                <option value="not ready" {{ old('car_status') == 'not ready' ? 'selected' : '' }}>Not Ready</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="car_photo" class="form-label">Car Photo</label>
            <img id="preview" class="img-fluid mt-2" style="max-height: 200px; display: none;" />

            <input type="file" name="car_photo" class="form-control" id="car_photo">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" id="price" value="{{ old('price') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
<script>
    document.getElementById('car_photo').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    });
</script>
@endsection

