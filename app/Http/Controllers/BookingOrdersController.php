<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Location;
use App\Models\BookingOrder;
use Illuminate\Http\Request;

class BookingOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookingOrders = BookingOrder::with(['pickUpLocation', 'dropLocation', 'carName'])->get();
        return view('booking_orders.index', compact('bookingOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        $cars = Car::all();
        return view('booking_orders.create', compact('locations', 'cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'phone_number' => 'required|string|max:20',
            'pick_up_location' => 'required|exists:locations,location_id',
            'drop_location' => 'required|exists:locations,location_id',
            'pickup_date' => 'required|date',
            'pickup_time' => 'required',
            'car' => 'required|exists:cars,cars_id',
            'request' => 'nullable|string',
            'payment'=>'required|in:cash,qris,transfer'
        ]);

        BookingOrder::create($request->all());

        return redirect()->route('booking_orders.index')->with('success', 'Booking order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bookingOrder = BookingOrder::with(['pickUpLocation', 'dropLocation', 'carName'])->findOrFail($id);
        return view('booking_orders.show', compact('bookingOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bookingOrder = BookingOrder::findOrFail($id);
        $locations = Location::all();
        $cars = Car::all();
        return view('booking_orders.edit', compact('bookingOrder', 'locations', 'cars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'phone_number' => 'required|string|max:20',
            'pick_up_location' => 'required|exists:locations,location_id',
            'drop_location' => 'required|exists:locations,location_id',
            'pickup_date' => 'required|date',
            'pickup_time' => 'required',
            'car' => 'required|exists:cars,cars_id',
            'request' => 'nullable|string',
            'payment'=>'required|in:cash,qris,transfer'
        ]);

        $bookingOrder = BookingOrder::findOrFail($id);
        $bookingOrder->update($request->all());

        return redirect()->route('booking_orders.index')->with('success', 'Booking order updated successfully.');
    }

    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bookingOrder = BookingOrder::findOrFail($id);
        $bookingOrder->delete();

        return redirect()->route('booking_orders.index')->with('success', 'Booking order deleted successfully.');
    }
}
