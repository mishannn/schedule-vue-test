@extends('layouts.base')

@section('meta')
    @parent
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
@endsection

@section('links')
    @parent
    <link href="{{ route('home') }}/css/app.css" rel="stylesheet">
@endsection

@section('scripts')
    @parent
    <script src="{{ route('home') }}/js/app.js"></script>
@endsection

@section('content')
    @parent
@endsection