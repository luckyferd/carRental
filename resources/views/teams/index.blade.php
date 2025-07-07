@extends('layouts.team')

@section('indexTable')
<div class="container">
    <h1>Teams</h1>
    <a href="{{ route('teams.create') }}" class="btn btn-primary mb-3">Add New Team</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Team Name</th>
                <th>Speciality</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teams as $team)
                <tr>
                    <td>{{ $team->team_id }}</td>
                    <td>{{ $team->team_name }}</td>
                    <td>{{ $team->speciality }}</td>
                    <td>
                        @if($team->photo)
                        <img src="{{ $team->photo }}" alt="Foto Tim" style="max-width: 200px;" />
                        @else
                            No Photo
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('teams.edit', $team->team_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('teams.destroy', $team->team_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('card')
@foreach ($teams as $team)
<div class="team-item">
    <img class="img-fluid w-100" src="{{ $team->photo ? asset('storage/' . $team->photo) : '/assets/img/default-photo.jpg' }}" alt="Team Photo">
    <div class="position-relative py-4">
        <h4 class="text-uppercase">{{ $team->team_name }}</h4>
        <p class="m-0">{{ $team->speciality }}</p>
        <div class="team-social position-absolute w-100 h-100 d-flex align-items-center justify-content-center">
            <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i class="fab fa-twitter"></i></a>
            <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>
</div>
@endforeach

@endsection
