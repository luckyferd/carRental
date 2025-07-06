@extends('layouts.serviceorder')

@section('content')
<div class="container">
    <h1>Edit Service Order</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('service_orders.update', $serviceorders->service_order_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ $serviceorders->customer_name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $serviceorders->email }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{ $serviceorders->phone }}">
        </div>

        <div class="mb-3">
            <label for="service_type" class="form-label">Service Type</label>
            <select name="service_type" id="service_type" class="form-select" required>
                @foreach($services as $service)
                    <option value="{{ $service->service_id }}" {{ $serviceorders->service_type == $service->service_id ? 'selected' : '' }}>
                        {{ $service->service_category }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="service_date" class="form-label">Service Date</label>
            <input type="date" name="service_date" class="form-control" id="service_date" value="{{ $serviceorders->service_date }}" required>
        </div>

        <div class="mb-3">
            <label for="service_time" class="form-label">Service Time</label>
            <input type="time" name="service_time" class="form-control" id="service_time" value="{{ $serviceorders->service_time }}" required>
        </div>

        <div class="mb-3">
            <label for="vehicle_name" class="form-label">Vehicle Name</label>
            <input type="text" name="vehicle_name" class="form-control" id="vehicle_name" value="{{ $serviceorders->vehicle_name }}" required>
        </div>

        <div class="mb-3">
            <label for="additional_notes" class="form-label">Additional Notes</label>
            <textarea name="additional_notes" class="form-control" id="additional_notes" rows="5">{{ $serviceorders->additional_notes }}</textarea>
        </div>

        <div class="mb-3">
            <label for="payment_methods" class="form-label">Payment Method</label>
            <select name="payment_methods" id="payment_methods" class="form-select" required>
                <option value="cash" {{ $serviceorders->payment_methods == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="qris" {{ $serviceorders->payment_methods == 'qris' ? 'selected' : '' }}>QRIS</option>
                <option value="bank_transfer" {{ $serviceorders->payment_methods == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
