@extends('layouts.car')

@section('content')
<div class="container">
    <h1>Edit Car</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cars.update', $cars->cars_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="cars_name" class="form-label">Car Name</label>
            <input type="text" name="cars_name" class="form-control" id="cars_name" value="{{ $cars->cars_name }}" required>
        </div>

        <div class="mb-3">
            <label for="car_type" class="form-label">Car Type</label>
            <select name="car_type" class="form-control" id="car_type" required>
                @foreach($carTypes as $type)
                    <option value="{{ $type->type_id }}" {{ $type->type_id == $cars->car_type ? 'selected' : '' }}>
                        {{ $type->type_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" required>{{ $cars->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="car_status" class="form-label">Car Status</label>
            <select name="car_status" class="form-control" id="car_status" required>
                <option value="ready" {{ $cars->car_status == 'ready' ? 'selected' : '' }}>Ready</option>
                <option value="not ready" {{ $cars->car_status == 'not ready' ? 'selected' : '' }}>Not Ready</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="car_photo" class="form-label">Car Photo</label>
            <input type="file" name="car_photo" class="form-control" id="car_photo">

            {{-- Gambar lama --}}
            @if($cars->car_photo)
                <p class="mt-2">Current Photo:</p>
                <img id="old-preview" class="img-fluid" src="{{ $cars->car_photo }}" alt="{{ $cars->cars_name }}" style="max-width: 200px;" />
            @endif

            {{-- Preview baru --}}
            <img id="preview" class="img-fluid mt-2" style="max-height: 200px; display: none;" />
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" id="price" value="{{ $cars->price }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>

{{-- Script preview --}}
<script>
    document.getElementById('car_photo').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview');
        const oldPreview = document.getElementById('old-preview');

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
            if (oldPreview) oldPreview.style.display = 'none';
        } else {
            preview.style.display = 'none';
            if (oldPreview) oldPreview.style.display = 'block';
        }
    });
</script>
@endsection
