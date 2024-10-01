@extends('email.app')

@section('email-content')
<div class="email-head-subject">
    <div class="title d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <a class="active" href="#">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star text-primary-muted">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </span>
            </a>
            <span>{{ $message->subject }}</span>
        </div>
    </div>
</div>

<div class="email-head-sender d-flex align-items-center justify-content-between flex-wrap">
    <div class="d-flex align-items-center">
        <div class="avatar">
            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Avatar" class="rounded-circle user-avatar-md">
        </div>
        <div class="sender d-flex align-items-center">
            <a href="#">{{ $message->senderUser->nama_user }}</a>
            <span>to</span>
            @foreach($message->messageTo as $recipient)
                <a href="#">{{ $recipient->toUser->nama_user }}</a>
            @endforeach
        </div>
    </div>
    <div class="date">{{ $message->created_date }}</div>
</div>

<div class="email-body">
    <p>{{ $message->message_text }}</p>
</div>

@if($message->documents->isNotEmpty())
    <div class="email-documents">
        <h5>Attachments:</h5>
        <ul>
            @foreach($message->documents as $document)
                <li>
                    <a href="{{ asset('storage/' . $document->file) }}" target="_blank">{{ $document->file }}</a>
                    @if($document->description)
                        <p>{{ $document->description }}</p>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endif
<div class="email-reply mt-5">
    <h5>Reply to this message:</h5>
    <form action="{{ route('reply.message', $message->message_id) }}" method="POST">
        @csrf
        <input type="hidden" name="to" value="{{ $message->sender }}"> 
        
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" class="form-control" value="Re: {{ $message->subject }}" readonly>
        </div>
        
        <div class="form-group">
            <label for="message_text">Message</label>
            <textarea id="message_text" name="message_text" class="form-control" rows="4" placeholder="Write your reply here..."></textarea>
        </div>
        
        <button type="submit" name="action" value="draft" class="btn btn-secondary">Save as Draft</button>
        <button type="submit" class="btn btn-primary">Send Reply</button>
    </form>
</div>

@endsection
