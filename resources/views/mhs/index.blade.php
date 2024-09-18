@extends('mhs.layout')

@section('title', 'Example Page')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/example.css') }}">
@endsection

@section('content')
    <h1>Welcome to Library</h1>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/example.js') }}"></script>
@endsection
