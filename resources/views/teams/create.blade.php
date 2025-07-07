@extends('layouts.team')

@section('content')
<div class="container">
    <h1>Add New Team</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="team_name" class="form-label">Team Name</label>
            <input type="text" name="team_name" class="form-control" id="team_name" value="{{ old('team_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="speciality" class="form-label">Speciality</label>
            <input type="text" name="speciality" class="form-control" id="speciality" value="{{ old('speciality') }}" required>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <img id="preview" class="img-fluid mt-2" style="max-height: 200px; display: none;" />

            <input type="file" name="photo" class="form-control" id="photo">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
<script>
    document.getElementById('photo').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    });
</script>
@endsection

