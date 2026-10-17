@extends('layouts.app')

@section('title', 'To-do list')

@section('header')
    <h1 class="text-2xl font-semibold">Tasks</h1>
@endsection

@section('content')
    <livewire:task-list />
@endsection
