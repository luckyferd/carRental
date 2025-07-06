@extends('layouts.about')
@section('content')
<!-- Form Create -->
<div class="container">

<form action="{{ route('locations.store') }}" method="POST">
    @csrf
    <div>
        <label for="location_name">Location Name:</label>
        <input type="text" name="location_name" id="location_name" placeholder="Enter location name" required maxlength="255">
    </div>

    <div>
        <label for="address">Address:</label>
        <textarea name="address" id="address" placeholder="Enter address" required></textarea>
    </div>

    <div>
        <button type="submit">Create</button>
    </div>
</form>
</div>
@endsection