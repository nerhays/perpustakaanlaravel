@extends('email.app')

@section('email-content')
<h3>Your Drafts</h3>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Subject</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drafts as $draft)
                <tr>
                    <td class="action"><input type="checkbox" /></td>
                    <td class="name"><a href="{{ route('edit.draft', $draft->message_id) }}">{{ auth()->user()->nama_user }}</a></td>
                    <td class="subject"><a href="{{ route('edit.draft', $draft->message_id) }}">{{ $draft->subject }}</a></td>
                    <td class="time">{{ $draft->create_date }}</td>
                    <td class="action">
                        <form action="{{ route('send.draft', $draft->message_id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Send Draft</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
