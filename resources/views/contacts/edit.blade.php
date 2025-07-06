@extends('layouts.contact')

@section('content')
<div class="col-lg-7 mb-2">
    <h1>Edit Contact</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="contact-form bg-light mb-4" style="padding: 30px;">
    <form action="{{ route('contacts.update', $contact->contact_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-6 form-group">
                <input type="text" name="name" class="form-control p-4" id="name" placeholder="Your Name" required="required" value="{{ $contact->name }}" required>
            </div>
            <div class="col-6 form-group">
                <input type="email" name="email" class="form-control p-4" id="email" placeholder="Your Email" required="required" value="{{ $contact->email }}" required>
            </div>
        </div>
        <div class="form-group">
            <input type="text" name="subject" class="form-control p-4" id="subject" placeholder="Subject" required="required" value="{{ $contact->subject }}" required>
        </div>
        <div class="form-group">
            <textarea class="form-control py-3 px-4" name="message" rows="5" placeholder="Message" id="message" row="5" required="required" required>{{ $contact->message }}</textarea>
        </div>
        <div>
            <button class="btn btn-primary py-3 px-5" type="submit">Update Message</button>
           <a  class="btn btn-warning py-3 px-5" href="{{route('contacts.index')}}"> Cancel</a>
        </div>
        
    </form>
</div>
</div>
@endsection
