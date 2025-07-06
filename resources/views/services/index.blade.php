@extends('layouts.service')

@section('indexTable')
<div class="container">
    <h2 class="mb-4">Service List</h2>
    <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Add New Service</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Service Category</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($services as $service)
            <tr>
                <td>{{ $service->service_id }}</td>
                <td>{{ $service->service_category }}</td>
                <td>{{ $service->description }}</td>
                <td>
                    <a href="{{ route('services.edit', $service->service_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('services.destroy', $service->service_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No services available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('card')
@foreach ($services as $service)
<div class="col-lg-4 col-md-6 mb-2">
    <div class="service-item d-flex flex-column justify-content-center px-4 mb-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h1 class="display-2 text-white mt-n2 m-0">{{$service->service_id}}</h1>
        </div>
        <h4 class="text-uppercase mb-3">{{ $service->service_category }}</h4>
        <p class="m-0">{{ $service->description }}</p>
    </div>
</div>
@endforeach
@endsection