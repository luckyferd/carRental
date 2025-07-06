@extends('layouts.serviceorder')

@section('indexTable')
<div class="container">
    <h1>Service Orders</h1>
    <a href="{{ route('service_orders.create') }}" class="btn btn-primary mb-3">Add New Service Order</a>

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
                <th>Service Type</th>
                <th>Service Date</th>
                <th>Vehicle Name</th>
                <th>Payment Method</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($serviceorders as $order)
                <tr>
                    <td>{{ $order->service_order_id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->serviceType->service_category }}</td> <!-- Assuming you have a relationship -->
                    <td>{{ $order->service_date }}</td>
                    <td>{{ $order->vehicle_name }}</td>
                    <td>{{ ucfirst($order->payment_methods) }}</td>
                    <td>
                        <a href="{{ route('service_orders.edit', $order->service_order_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('service_orders.destroy', $order->service_order_id) }}" method="POST" style="display:inline;">
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
