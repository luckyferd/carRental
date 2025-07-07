<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class TeamsController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'team_name' => 'required|string|max:50',
        'speciality' => 'required|string|max:50',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        try {
            $uploaded = Cloudinary::upload($request->file('photo')->getRealPath(), [
                'folder' => 'teams'
            ]);
            $validated['photo'] = $uploaded->getSecurePath(); // URL gambar
            $validated['photo_public_id'] = $uploaded->getPublicId(); // ← ini penting untuk hapus nanti
        } catch (\Exception $e) {
            return back()->withErrors(['photo' => 'Upload gagal: ' . $e->getMessage()]);
        }
    }

    Team::create($validated);

    return redirect()->route('teams.index')->with('success', 'Team created successfully.');
}


    public function show(string $id)
    {
        $team = Team::findOrFail($id);
        return view('teams.show', compact('team'));
    }

    public function edit(string $id)
    {
        $team = Team::findOrFail($id);
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, string $id)
    {
        $team = Team::findOrFail($id);
    
        $validated = $request->validate([
            'team_name' => 'required|string|max:50',
            'speciality' => 'required|string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        if ($request->hasFile('photo')) {
            try {
                // Hapus foto lama jika ada public_id
                if ($team->photo_public_id) {
                    Cloudinary::destroy($team->photo_public_id);
                }
    
                $uploaded = Cloudinary::upload($request->file('photo')->getRealPath(), [
                    'folder' => 'teams'
                ]);
    
                $validated['photo'] = $uploaded->getSecurePath(); // URL gambar
                $validated['photo_public_id'] = $uploaded->getPublicId(); // Simpan ID untuk penghapusan
            } catch (\Exception $e) {
                return back()->withErrors(['photo' => 'Upload gagal: ' . $e->getMessage()]);
            }
        }
    
        $team->update($validated);
    
        return redirect()->route('teams.index')->with('success', 'Team updated successfully.');
    }

    public function destroy(string $id)
    {
        $team = Team::findOrFail($id);

        // Tidak perlu hapus dari Cloudinary kecuali kamu simpan public_id (bisa ditambahkan nanti)
        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Team deleted successfully.');
    }
}
