@extends('layouts.car')

@section('card')
@foreach ($cars as $car )
<div class="col-lg-4 col-md-6 mb-2">
    <div class="rent-item mb-4">
        <img class="img-fluid" src="{{ $cars->car_photo ?? asset('images/default-car.png') }}" alt="{{ $cars->cars_name }}">

        <h4 class="text-uppercase mb-4">{{$car->cars_name}}</h4>
        <div class="d-flex justify-content-center mb-4">
            <div class="px-2">
                <i class="fa fa-car text-primary mr-1"></i>
                <span>{{ $car->carType->type_name ?? 'Unknown' }}</span>
            </div>
            <div class="px-2 border-left border-right">
                <i class="fa fa-cogs text-primary mr-1"></i>
                <span>{{$car->car_status}}</span>
            </div>
            <div class="px-2">
                <i class="fa fa-road text-primary mr-1"></i>
                <span>{{$car->price}}</span>
            </div>
        </div>
        <a href="{{ route('cars.show', $car->cars_id) }}" class="btn btn-primary px-3" href="">{{$car->price}}/Day</a>
    </div>
</div>
@endforeach
@endsection

@section('tableIndex')
<div class="container">
    <h1 class="mb-4">Cars</h1>
    <a href="{{ route('cars.create') }}" class="btn btn-primary mb-3">Add New Car</a>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Description</th>
                <th>Status</th>
                <th>Photo</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cars as $car)
            <tr>
                <td>{{ $car->cars_id }}</td>
                <td>{{ $car->cars_name }}</td>
                <td>{{ $car->carType->type_name }}</td> <!-- Assuming a relationship exists -->
                <td>{{ $car->description }}</td>
                <td>{{ ucfirst($car->car_status) }}</td>
                <td>
                    @if($car->car_photo)
                    <img src="{{ asset('storage/' . $car->car_photo) }}" alt="Car Photo" width="100">
                    @else
                    <span>No Photo</span>
                    @endif
                </td>
                <td>{{ number_format($car->price, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('cars.edit', $car->cars_id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('cars.destroy', $car->cars_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No cars available.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
</div>

@endsection