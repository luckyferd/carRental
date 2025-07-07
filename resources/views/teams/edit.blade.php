@extends('layouts.team')

@section('content')
<div class="container">
    <h1>Edit Team</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teams.update', $team->team_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="team_name" class="form-label">Team Name</label>
            <input type="text" name="team_name" class="form-control" id="team_name" value="{{ $team->team_name }}" required>
        </div>

        <div class="mb-3">
            <label for="speciality" class="form-label">Speciality</label>
            <input type="text" name="speciality" class="form-control" id="speciality" value="{{ $team->speciality }}" required>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control" id="photo">
            
            {{-- Tampilkan foto lama --}}
            @if($team->photo)
                <p class="mt-2">Current Photo:</p>
                <img id="old-preview" src="{{ $team->photo }}" alt="Foto Tim" style="max-width: 200px;" />
            @endif

            {{-- Preview foto baru --}}
            <img id="preview" class="img-fluid mt-2" style="max-height: 200px; display: none;" />
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>

{{-- Script preview --}}
<script>
    document.getElementById('photo').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview');
        const oldPreview = document.getElementById('old-preview');

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
            if (oldPreview) oldPreview.style.display = 'none';
        } else {
            preview.style.display = 'none';
            if (oldPreview) oldPreview.style.display = 'block';
        }
    });
</script>
@endsection
