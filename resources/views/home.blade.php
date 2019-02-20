<?php /** @var $errors \Illuminate\Support\MessageBag */ ?>

@extends('layouts.bootstrap')

@section('title', 'Расписание')

@section('content')
    @parent
    <div id="schedule"></div>
@endsection

@section('links')
    @parent
    <link src="{{ route('home') }}/css/schedule.css"/>
@endsection

@section('scripts')
    @parent
    <script src="{{ route('home') }}/js/schedule.js"></script>
@endsection