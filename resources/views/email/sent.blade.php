@extends('email.app')

@section('email-content')
    <h3>Sent Mail</h3>
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
                @foreach($messages as $message)
                <tr>
                    <td class="action"><input type="checkbox" /></td>
                    <td class="name">
                        @foreach($message->messageTo as $recipient)
                            <a href="{{ route('read.message', $message->message_id) }}">
                                Kepada : {{ $recipient->toUser->nama_user }}
                            </a>
                        @endforeach
                    </td>
                    <td class="subject"><a href="{{ route('read.message', $message->message_id) }}">{{ $message->subject }}</a></td>
                    <td class="time">{{ $message->create_date ?? 'No date available' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
