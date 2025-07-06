@extends('layouts.cartype')
@section('content')
<div class="container">
    <h1>Add Car Type</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('car_types.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="type_name" class="form-label">Type Name</label>
            <input type="text" name="type_name" class="form-control" id="type_name" value="{{ old('type_name') }}">
        </div>
        <div class="mb-3">
            <label for="type_description" class="form-label">Type Description</label>
            <textarea name="type_description" class="form-control" id="type_description">{{ old('type_description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection