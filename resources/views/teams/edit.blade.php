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
            @if($team->photo)
                <img src="{{ asset('storage/' . $team->photo) }}" alt="Team Photo" class="img-thumbnail mt-2" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
