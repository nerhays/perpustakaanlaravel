@extends('email.app')

@section('email-content')
    <h3>Inbox</h3>
    <div class="table-responsive">
        <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Subject</th>
                <th>Time</th>
            </tr>
        </thead>
            <tbody>
                @foreach($messages as $messageTo)
                <tr class="{{ $messageTo->message->message_status ? 'read' : '' }}">
                    <td class="action"><input type="checkbox" /></td>
                    <td class="name"><a href="{{ route('read.message', $messageTo->message->message_id) }}">{{ $messageTo->message->senderUser->nama_user }}</a></td>
                    <td class="subject"><a href="{{ route('read.message', $messageTo->message->message_id) }}">{{ $messageTo->message->subject }}</a></td>
                    <td class="time">{{ $messageTo->message->create_date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
