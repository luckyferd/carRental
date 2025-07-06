@extends('layouts.detail')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Foto mobil -->
            <img class="img-fluid" src="{{ $cars->car_photo ? asset('storage/' . $cars->car_photo) : asset('images/default-car.png') }}" alt="{{ $cars->cars_name }}">
        </div>
        <div class="col-md-6">
            <!-- Detail mobil -->
            <h2>{{ $cars->cars_name }}</h2>
            <p><strong>Type:</strong> {{ $cars->carType->type_name }}</p>
            <p><strong>Status:</strong> {{ $cars->car_status }}</p>
            <p><strong>Price:</strong> Rp. {{ $cars->price }}</p>
            <p><strong>Description:</strong> {{ $cars->description }}</p>
            <a href="{{ route('cars.index') }}" class="btn btn-secondary">Back to Listing</a>
            <a href="{{route('booking_orders.create')}}" class="btn btn-primary">Book</a>
        </div>
    </div>
</div>
    </div>
</div>

@endsection