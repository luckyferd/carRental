@extends('layouts.about')

@section('tableIndex')

<div class="container">
    <h2 class="mb-4">Location List</h2>
    <a href="{{ route('locations.create') }}" class="btn btn-primary mb-3">Add New Service</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Location Name</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($locations as $location)
            <tr>
                <td>{{ $location->location_id }}</td>
                <td>{{ $location->location_name }}</td>
                <td>{{ $location->address }}</td>
                <td>
                    <a href="{{ route('locations.edit', $location->location_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('locations.destroy', $location->location_id) }}" method="POST" style="display:inline;">
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