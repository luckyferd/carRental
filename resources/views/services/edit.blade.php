@extends('layouts.service')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Service</h2>
    <form action="{{ route('services.update', $service->service_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="service_category" class="form-label">Service Category</label>
            <input type="text" class="form-control" id="service_category" name="service_category" value="{{ $service->service_category }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ $service->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('services.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection