@extends('email.app')

@section('email-content')
<div class="email-compose">
    <h3>Edit Draft</h3>
    <form action="{{ route('update.draft', $draft->message_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" name="subject" id="subject" value="{{ $draft->subject }}" required>
        </div>
        <div class="form-group">
            <label for="message_text">Message</label>
            <textarea class="form-control" name="message_text" id="message_text" rows="10" required>{{ $draft->message_text }}</textarea>
        </div>
        <div class="form-group">
            <label for="to">To</label>
            <input type="text" class="form-control" name="to" id="to" value="{{ $draft->messageTo->first()->toUser->email }}" required>
        </div>
        <button type="submit" class="btn btn-secondary">Update Draft</button>
    </form>
    <form action="{{ route('send.draft', $draft->message_id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-primary btn-sm">Send</button>
        </form>
</div>
@endsection
