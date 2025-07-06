@extends('layouts.contact')

@section('content')


<div class="col-lg-7 mb-2">
    <h1>Send Message</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <a href="{{ route('contacts.index') }}" class="btn btn-primary mb-3">view message</a>
    <div class="contact-form bg-light mb-4" style="padding: 30px;">
        <form action="{{ route('contacts.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-6 form-group">
                    <input type="text" name="name" class="form-control p-4" id="name" placeholder="Your Name" required="required" value="{{ old('name') }}">
                </div>
                <div class="col-6 form-group">
                    <input type="email" name="email" class="form-control p-4" id="email" placeholder="Your Email" required="required" value="{{ old('email') }}">
                </div>
            </div>
            <div class="form-group">
                <input type="text" name="subject" class="form-control p-4" id="subject" placeholder="Subject" required="required" value="{{ old('subject') }}">
            </div>
            <div class="form-group">
                <textarea class="form-control py-3 px-4" name="message" rows="5" placeholder="Message" id="message" row="5" required="required" required>{{ old('message') }}</textarea>
            </div>
            <div>
                <button class="btn btn-primary py-3 px-5" type="submit">Send Message</button>
            </div>
        </form>
    </div>
</div>
@endsection


