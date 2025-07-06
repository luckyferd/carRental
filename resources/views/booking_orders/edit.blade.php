@extends('layouts.booking')
@section('content')
<div class="container">
    <h1>Edit Booking Order</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('booking_orders.update', $bookingOrder->booking_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ $bookingOrder->customer_name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $bookingOrder->email }}" required>
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" id="phone_number" value="{{ $bookingOrder->phone_number }}" required>
        </div>

        <div class="mb-3">
            <label for="pick_up_location" class="form-label">Pick-up Location</label>
            <select name="pick_up_location" class="form-control" id="pick_up_location" required>
                @foreach($locations as $location)
                    <option value="{{ $location->location_id }}" {{ $location->location_id == $bookingOrder->pick_up_location ? 'selected' : '' }}>
                        {{ $location->location_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="drop_location" class="form-label">Drop Location</label>
            <select name="drop_location" class="form-control" id="drop_location" required>
                @foreach($locations as $location)
                    <option value="{{ $location->location_id }}" {{ $location->location_id == $bookingOrder->drop_location ? 'selected' : '' }}>
                        {{ $location->location_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="pickup_date" class="form-label">Pickup Date</label>
            <input type="date" name="pickup_date" class="form-control" id="pickup_date" value="{{ $bookingOrder->pickup_date }}" required>
        </div>

        <div class="mb-3">
            <label for="pickup_time" class="form-label">Pickup Time</label>
            <input type="time" name="pickup_time" class="form-control" id="pickup_time" value="{{ $bookingOrder->pickup_time }}" required>
        </div>

        <div class="mb-3">
            <label for="car" class="form-label">Car</label>
            <select name="car" class="form-control" id="car" required>
                @foreach($cars as $car)
                    <option value="{{ $car->cars_id }}" {{ $car->cars_id == $bookingOrder->car ? 'selected' : '' }}>
                        {{ $car->cars_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="request" class="form-label">Request</label>
            <textarea name="request" class="form-control" id="request" required>{{ $bookingOrder->request }}</textarea>
        </div>

        <div class="mb-3">
            <label for="payment" class="form-label">Payment</label>
            <select name="payment" class="form-control" id="payment" required>
                <option value="cash" {{ $bookingOrder->payment == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="qris" {{ $bookingOrder->payment == 'qris' ? 'selected' : '' }}>QRIS</option>
                <option value="transfer" {{ $bookingOrder->payment == 'transfer' ? 'selected' : '' }}>Transfer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection