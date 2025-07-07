<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarType;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CarsController extends Controller
{
    public function index()
    {
        $cars = Car::with('carType')->get();
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        $carTypes = CarType::all();
        return view('cars.create', compact('carTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cars_name' => 'required|string|max:50',
            'car_type' => 'required|exists:car_types,type_id',
            'description' => 'required|string',
            'car_status' => 'required|in:ready,not ready',
            'car_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'nullable|numeric|min:0',
        ]);
    
        $validated['price'] = $validated['price'] ?? 0;
    
        if ($request->hasFile('car_photo')) {
            $uploaded = Cloudinary::upload($request->file('car_photo')->getRealPath(), [
                'folder' => 'cars'
            ]);
    
            $validated['car_photo'] = $uploaded->getSecurePath();
            $validated['car_photo_public_id'] = $uploaded->getPublicId(); // Simpan untuk delete nanti
        }
    
        Car::create($validated);
    
        return redirect()->route('cars.index')->with('success', 'Car created successfully.');
    }
    

    public function show(string $id)
    {
        $cars = Car::with('carType')->where('cars_id', $id)->firstOrFail();
        return view('cars.show', compact('cars'));
    }

    public function edit(string $id)
    {
        $cars = Car::where('cars_id', $id)->firstOrFail();
        $carTypes = CarType::all();
        return view('cars.edit', compact('cars', 'carTypes'));
    }

    public function update(Request $request, string $id)
    {
        $cars = Car::where('cars_id', $id)->firstOrFail();

        $validated = $request->validate([
            'cars_name' => 'required|string|max:50',
            'car_type' => 'required|exists:car_types,type_id',
            'description' => 'required|string',
            'car_status' => 'required|in:ready,not ready',
            'car_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'nullable|numeric|min:0',
        ]);

        $validated['price'] = $validated['price'] ?? 0;

        if ($request->hasFile('car_photo')) {
            // Hapus foto lama dari Cloudinary
            if ($cars->car_photo_public_id) {
                Cloudinary::destroy($cars->car_photo_public_id);
            }
        
            $uploaded = Cloudinary::upload($request->file('car_photo')->getRealPath(), [
                'folder' => 'cars'
            ]);
            $validated['car_photo'] = $uploaded->getSecurePath();
            $validated['car_photo_public_id'] = $uploaded->getPublicId();
        }
        $cars->update($validated);

        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
    
        if ($car->car_photo_public_id) {
            Cloudinary::destroy($car->car_photo_public_id);
        }
        $car->delete();
        $car->car_photo = null;
        $car->car_photo_public_id = null;
        $car->save();
    
        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }
    
}
