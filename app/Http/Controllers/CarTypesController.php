<?php

namespace App\Http\Controllers;

use App\Models\CarType;
use Illuminate\Http\Request;

class CarTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carTypes = CarType::all();
        return view('car_types.index', compact('carTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('car_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_name' => 'required|string|max:50',
            'type_description' => 'required|string',
        ]);

        CarType::create($validated);

        return redirect()->route('car_types.index')->with('success', 'Car Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $carType = CarType::findOrFail($id);
        return view('car_types.show', compact('carType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $carType = CarType::findOrFail($id);
        return view('car_types.edit', compact('carType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $carType = CarType::findOrFail($id);

        $validated = $request->validate([
            'type_name' => 'required|string|max:50',
            'type_description' => 'required|string',
        ]);

        $carType->update($validated);

        return redirect()->route('car_types.index')->with('success', 'Car Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $carType = CarType::findOrFail($id);
        $carType->delete();

        return redirect()->route('car_types.index')->with('success', 'Car Type deleted successfully.');
    }
}
