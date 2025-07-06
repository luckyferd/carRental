@extends('layouts.testimonial')

@section('indexTable')
<div class="container">
    <h1>Testimonials</h1>
    <a href="{{ route('testimonials.create') }}" class="btn btn-primary mb-3">Add New Testimonial</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer Name</th>
                <th>Profession</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($testimonials as $testimonial)
                <tr>
                    <td>{{ $testimonial->testimonial_id }}</td>
                    <td>{{ $testimonial->customer_name }}</td>
                    <td>{{ $testimonial->profession }}</td>
                    <td>"{{ \Illuminate\Support\Str::limit($testimonial->description, 50) }}"</td>
                    <td>
                        <a href="{{ route('testimonials.edit', $testimonial->testimonial_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('testimonials.destroy', $testimonial->testimonial_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('card')
<div class="container py-5">
    <h1 class="display-4 text-uppercase text-center mb-5">Our Client's Say</h1>
    <div class="owl-carousel testimonial-carousel">
        @foreach($testimonials as $testimonial)
        <div class="testimonial-item d-flex flex-column justify-content-center px-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <img class="img-fluid ml-n4" src="/assets/img/testimonial-1.jpg" alt="">
                <h1 class="display-2 text-white m-0 fa fa-quote-right"></h1>
            </div>
            <h4 class="text-uppercase mb-2">{{ $testimonial->customer_name }}</h4>
            
            <i class="mb-2">{{ $testimonial->profession }}</i>
            <p class="m-0">"{{ \Illuminate\Support\Str::limit($testimonial->description, 50) }}"</p>
        </div>
        @endforeach
    </div>
</div>
@endsection