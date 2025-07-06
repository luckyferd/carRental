
@extends('layouts.booking')

@section('content')
<!-- Car Booking Start -->
<form action="{{ route('booking_orders.store') }}" method="POST">
    @csrf
    <div class="container-fluid pb-5">
       
        <div class="container">
            <a href="{{ route('booking_orders.index') }}" class="btn btn-primary mb-3">view booking</a>
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="mb-4">Personal Detail</h2>
                    <div class="mb-5">
                        <div class="row">
                            <div class="col-6 form-group">
                                <input type="text" name="customer_name" class="form-control p-4" placeholder="First Name" required>
                            </div>
                            <div class="col-6 form-group">
                                <input type="text" name="last_name" class="form-control p-4" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                                <input type="email" name="email" class="form-control p-4" placeholder="Your Email" required>
                            </div>
                            <div class="col-6 form-group">
                                <input type="text" name="phone_number" class="form-control p-4" placeholder="Mobile Number" required>
                            </div>
                        </div>
                    </div>
                    <h2 class="mb-4">Booking Detail</h2>
                    <div class="mb-5">
                        <div class="row">
                            <div class="col-6 form-group">
                                <select name="pick_up_location" class="custom-select px-4" style="height: 50px;" required>
                                    <option selected disabled>Pickup Location</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->location_id }}">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 form-group">
                                <select name="drop_location" class="custom-select px-4" style="height: 50px;" required>
                                    <option selected disabled>Drop Location</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->location_id }}">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                                <input type="date" name="pickup_date" class="form-control p-4" placeholder="Pickup Date" required>
                            </div>
                            <div class="col-6 form-group">
                                <input type="time" name="pickup_time" class="form-control p-4" placeholder="Pickup Time" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                                <select name="car" class="custom-select px-4" style="height: 50px;" required>
                                    <option selected disabled>Select Car</option>
                                    @foreach($cars as $car)
                                        <option value="{{ $car->cars_id }}">{{ $car->cars_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="request" class="form-control py-3 px-4" rows="3" placeholder="Special Request"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-secondary p-5 mb-5">
                        <h2 class="text-primary mb-4">Payment</h2>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="payment" value="cash" class="custom-control-input" id="cash">
                                <label class="custom-control-label" for="cash">Cash</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="payment" value="qris" class="custom-control-input" id="qris">
                                <label class="custom-control-label" for="qris">Qris</label>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="payment" value="transfer" class="custom-control-input" id="transfer">
                                <label class="custom-control-label" for="transfer">Transfer</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary py-3">Reserve Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection