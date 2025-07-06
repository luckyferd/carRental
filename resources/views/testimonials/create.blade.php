@extends('layouts.testimonial')

@section('content')
<div class="container">
    <h1>Add New Testimonial</h1>
    <a href="{{ route('testimonials.index') }}" class="btn btn-primary mb-3">view testimonials</a>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('testimonials.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ old('customer_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="profession" class="form-label">Profession</label>
            <input type="text" name="profession" class="form-control" id="profession" value="{{ old('profession') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
