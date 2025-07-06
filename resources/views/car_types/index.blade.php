@extends('layouts.cartype')

@section('card')
@foreach ($carTypes as $carType)
<div class="col-lg-4 col-md-6 mb-2">
    <div class="rent-item mb-4">
        
        <h4 class="text-uppercase mb-4">{{ $carType->type_name }}</h4>
        <div class="d-flex justify-content-center mb-4">
            <div class="px-2 border-left border-right">
                <i class="fa fa-cogs text-primary mr-1"></i>
                <span>{{ $carType->type_description }}</span>
            </div>
        </div>
        <a href="{{ route('cars.index') }}" class="btn btn-primary px-3" href="">take me</a>
    </div>
</div>
@endforeach
@endsection

@section('indexTable')
<div class="container">
    <h1>Car Types</h1>
    <a href="{{ route('car_types.create') }}" class="btn btn-primary mb-3">Add New Car Type</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carTypes as $carType)
                <tr>
                    <td>{{ $carType->type_id }}</td>
                    <td>{{ $carType->type_name }}</td>
                    <td>{{ $carType->type_description }}</td>
                    <td>
                        <a href="{{ route('car_types.edit', $carType->type_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('car_types.destroy', $carType->type_id) }}" method="POST" style="display:inline;">
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