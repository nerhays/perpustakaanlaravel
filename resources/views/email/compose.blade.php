@extends('email.app')

@section('email-content')
<div class="compose-email">
    <form action="{{ route('send.message') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="to">To:</label>
            <select name="to[]" id="to" class="form-control select2" multiple required>
                @foreach($users as $user)
                    <option value="{{ $user->id_user }}">{{ $user->email }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="message_text">Message:</label>
            <textarea name="message_text" id="message_text" class="form-control" rows="6" required></textarea>
        </div>

        <div class="form-group">
            <label for="file">Attach a file (optional):</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>

        <div class="form-group">
            <label for="file_description">File Description (optional):</label>
            <input type="text" name="file_description" id="file_description" class="form-control">
        </div>
    
        <div class="form-group">
            <button type="submit" name="action" value="draft" class="btn btn-secondary">Save as Draft</button>
            <button type="submit" name="action" value="send" class="btn btn-primary">Send</button>
        </div>
    </form>
</div>
@endsection
