<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;

class ServiceOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceorders = ServiceOrder::with('serviceType')->get();
        return view('service_orders.index', compact('serviceorders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services=Service::all();
        return view('service_orders.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'customer_name'=>'required|string|max:50',
            'email'=>'required|email|max:50',
            'phone'=>'nullable|string|max:15',
            'service_type'=>'required|exists:services,service_id',
            'service_date'=>'required|date',
            'service_time'=>'required|date_format:H:i',
            'vehicle_name'=>'nullable',
            'additional_notes'=>'nullable',
            'payment_methods'=>'required|in:cash,qris,bank_transfer',
        ]);

        ServiceOrder::create($validated);
        return redirect()->route('service_orders.index')->with('success','Service Order Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $serviceorders=ServiceOrder::with('service_type')->findOrFail($id);
        return view('service_orders.show', compact('serviceorders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $serviceorders=ServiceOrder::findOrFail($id);
        $services=Service::all();
        return view('service_orders.edit', compact('serviceorders','services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $serviceorders=ServiceOrder::findOrFail($id);

        $validated=$request->validate([
            'customer_name'=>'required|string|max:50',
            'email'=>'required|email|max:50',
            'phone'=>'nullable|string|max:15',
            'service_type'=>'required|exists:services,service_id',
            'service_date'=>'required|date',
            'service_time'=>'required|date_format:H:i',
            'vehicle_name'=>'nullable|',
            'additional_notes'=>'nullable|',
            'payment_methods'=>'required|in:cash,qris,bank_transfer',
        ]);

        
        $serviceorders->update($validated);

        return redirect()->route('service_orders.index')->with('success', 'Service Order Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $serviceorders=ServiceOrder::findOrFail($id);
        $serviceorders->delete();

        return redirect()->route('service_orders.index')->with('success', 'Service Order deleted successfully.');
    }
}
