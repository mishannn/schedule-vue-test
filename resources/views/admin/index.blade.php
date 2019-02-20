<?php /** @var $errors \Illuminate\Support\MessageBag */ ?>

@extends('layouts.bootstrap')

@section('title', 'Админка')

@section('content')
    @parent
    <div id="admin-panel"></div>
@endsection

@section('links')
    @parent
    <link src="{{ route('home') }}/css/admin.css"/>
@endsection

@section('scripts')
    @parent
    <script src="{{ route('home') }}/js/admin.js"></script>
@endsection