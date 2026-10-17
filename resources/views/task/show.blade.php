@extends('layouts.app')

@section('title', 'Task')

@section('header')
    <h1 class="text-2xl font-semibold">Task #{{ $task->id }}</h1>
@endsection

@section('content')
    @php
        $statusBadge = match ($task->status) {
            'done' => 'badge-success',
            'doing' => 'badge-warning',
            default => 'badge-ghost',
        };
        $priorityBadge = match ($task->priority) {
            'high' => 'badge-error',
            'medium' => 'badge-warning',
            default => 'badge-info',
        };
    @endphp

    <div class="mx-auto max-w-2xl rounded-box bg-base-100 p-6 shadow">
        <h2 class="mb-1 text-xl font-bold">{{ $task->name }}</h2>
        <div class="mb-4 flex gap-2">
            <span class="badge {{ $statusBadge }}">{{ $task->status }}</span>
            <span class="badge {{ $priorityBadge }}">{{ $task->priority }}</span>
        </div>

        <p class="mb-6 whitespace-pre-line text-base-content/80">{{ $task->description }}</p>

        <dl class="grid grid-cols-1 gap-3 sm:grid-cols-2">
            <div class="rounded-box bg-base-200 p-3">
                <dt class="text-xs uppercase opacity-60">Start time</dt>
                <dd>{{ $task->startTime?->format('Y-m-d') }}</dd>
            </div>
            <div class="rounded-box bg-base-200 p-3">
                <dt class="text-xs uppercase opacity-60">End time</dt>
                <dd>{{ $task->endTime?->format('Y-m-d') }}</dd>
            </div>
            <div class="rounded-box bg-base-200 p-3">
                <dt class="text-xs uppercase opacity-60">Created at</dt>
                <dd>{{ $task->created_at?->format('Y-m-d H:i') }}</dd>
            </div>
            <div class="rounded-box bg-base-200 p-3">
                <dt class="text-xs uppercase opacity-60">Updated at</dt>
                <dd>{{ $task->updated_at?->format('Y-m-d H:i') }}</dd>
            </div>
        </dl>

        <div class="mt-6 flex items-center gap-3">
            <a class="btn btn-primary" href="{{ route('tasks.edit', $task) }}">Edit</a>
            <a class="btn btn-ghost" href="{{ route('tasks.index') }}">Back</a>
        </div>
    </div>
@endsection
