@extends('layouts.booking')
@section('tableIndex')
<div class="container">
    <h1>Booking Orders</h1>
    <a href="{{ route('booking_orders.create') }}" class="btn btn-primary mb-3">Add New Booking</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Pick-up Location</th>
                <th>Drop Location</th>
                <th>Pickup Date</th>
                <th>Pickup Time</th>
                <th>Car</th>
                <th>Payment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookingOrders as $order)
                <tr>
                    <td>{{ $order->booking_id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->phone_number }}</td>
                    <td>{{ $order->pickUpLocation->location_name }}</td>
                    <td>{{ $order->dropLocation->location_name }}</td>
                    <td>{{ $order->pickup_date }}</td>
                    <td>{{ $order->pickup_time}}</td>
                    <td>{{ $order->carName->cars_name }}</td>
                    <td>{{ ucfirst($order->payment) }}</td>
                    <td>
                        <a href="{{ route('booking_orders.edit', $order->booking_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('booking_orders.destroy', $order->booking_id) }}" method="POST" style="display:inline;">
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