@extends('layouts.about')
@section('content')
<!-- Form Edit -->
<form action="{{ route('locations.update', $location->location_id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="location_name">Location Name:</label>
        <input type="text" name="location_name" id="location_name" value="{{ old('location_name', $location->location_name) }}" required maxlength="255">
    </div>

    <div>
        <label for="address">Address:</label>
        <textarea name="address" id="address" required>{{ old('address', $location->address) }}</textarea>
    </div>

    <div>
        <button type="submit">Update</button>
    </div>
</form>
@endsection