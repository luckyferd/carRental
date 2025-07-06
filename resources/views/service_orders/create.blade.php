@extends('layouts.serviceorder')

@section('content')
<div class="container">
    <h1>Add New Service Order</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <a href="{{ route('service_orders.index') }}" class="btn btn-primary mb-3">view service orders</a>
    <form action="{{ route('service_orders.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ old('customer_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label for="service_type" class="form-label">Service Type</label>
            <select name="service_type" id="service_type" class="form-select" required>
                <option value="" disabled selected>Select Service Type</option>
                @foreach($services as $service)
                    <option value="{{ $service->service_id }}" {{ old('service_type') == $service->service_id ? 'selected' : '' }}>
                        {{ $service->service_category }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="service_date" class="form-label">Service Date</label>
            <input type="date" name="service_date" class="form-control" id="service_date" value="{{ old('service_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="service_time" class="form-label">Service Time</label>
            <input type="time" name="service_time" class="form-control" id="service_time" value="{{ old('service_time') }}" required>
        </div>

        <div class="mb-3">
            <label for="vehicle_name" class="form-label">Vehicle Name</label>
            <input type="text" name="vehicle_name" class="form-control" id="vehicle_name" value="{{ old('vehicle_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="additional_notes" class="form-label">Additional Notes</label>
            <textarea name="additional_notes" class="form-control" id="additional_notes" rows="5">{{ old('additional_notes') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="payment_methods" class="form-label">Payment Method</label>
            <select name="payment_methods" id="payment_methods" class="form-select" required>
                <option value="" disabled selected>Select Payment Method</option>
                <option value="cash" {{ old('payment_methods') == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="qris" {{ old('payment_methods') == 'qris' ? 'selected' : '' }}>QRIS</option>
                <option value="bank_transfer" {{ old('payment_methods') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
