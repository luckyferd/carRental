<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::with('carType')->get(); // Eager load the carType relationship
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carTypes = CarType::all(); // Fetch car types for the dropdown
        return view('cars.create', compact('carTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'cars_name' => 'required|string|max:50',
            'car_type' => 'required|exists:car_types,type_id',
            'description' => 'required|string',
            'car_status' => 'required|in:ready,not ready',
            'car_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Limit file size to 2MB
            'price'=>'nullable|numeric|min:0'
        ]);
        $validated['price'] = $validated['price'] ?? 0;//baru ditambahkan bisa saja menyebabkan masalah


        if ($request->hasFile('car_photo')) {
            $validated['car_photo'] = $request->file('car_photo')->store('car_photos', 'public');
        }

        Car::create($validated);

        return redirect()->route('cars.index')->with('success', 'Car created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cars = Car::with('carType')->where('cars_id', $id)->firstOrFail();
        return view('cars.show', compact('cars'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cars = Car::where('cars_id', $id)->firstOrFail();
        $carTypes = CarType::all();
        return view('cars.edit', compact('cars', 'carTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cars = Car::where('cars_id', $id)->firstOrFail();


        $validated = $request->validate([
            'cars_name' => 'required|string|max:50',
            'car_type' => 'required|exists:car_types,type_id',
            'description' => 'required|string',
            'car_status' => 'required|in:ready,not ready',
            'car_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price'=>'nullable|numeric|min:0'
        ]);
        $validated['price'] = $validated['price'] ?? 0;//baru ditambahkan bisa saja menyebabkan masalah

        if ($request->hasFile('car_photo')) {
            // Delete the old photo if it exists
            if ($cars->car_photo && Storage::exists('public/' . $cars->car_photo)) {
                Storage::delete('public/' . $cars->car_photo);
            }
            $validated['car_photo'] = $request->file('car_photo')->store('car_photos', 'public');
        }

        $cars->update($validated);

        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cars = Car::findOrFail($id);

        if ($cars->car_photo && Storage::exists('public/' . $cars->car_photo)) {
            Storage::delete('public/' . $cars->car_photo);
        }

        $cars->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
}
