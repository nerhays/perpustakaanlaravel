@extends('layouts.app')

@section('title', 'Example Page')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/example.css') }}">
@endsection

@section('content')
    <h1>Hello, {{ auth()->user()->nama_user }}! Welcome to the Library</h1>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/example.js') }}"></script>
@endsection
