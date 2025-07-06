
@extends('layouts.cartype')

@section('content')
<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
</div>

<div class="container">
<form action="{{ route('car_types.update', $carType->type_id) }}" method="POST">
@csrf
@method('PUT')
<div class="mb-3">
<label for="type_name" class="form-label">Type Name</label>
<input type="text" name="type_name" class="form-control" id="type_name" value="{{ $carType->type_name }}">
</div>
<div class="mb-3">
<label for="type_description" class="form-label">Type Description</label>
<textarea name="type_description" class="form-control" id="type_description">{{ $carType->type_description }}</textarea>
</div>
<button type="submit" class="btn btn-success">Update</button>
</form>
</div>
</div>
@endsection