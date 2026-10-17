@extends('layouts.app')

@section('title', 'Create task')

@section('header')
    <h1 class="text-2xl font-semibold">Create task</h1>
@endsection

@section('content')
    <div class="mx-auto max-w-2xl rounded-box bg-base-100 p-6 shadow">
        <form action="{{ route('tasks.store') }}" method="post" class="space-y-4">
            @csrf

            <div class="form-control">
                <label class="label" for="name"><span class="label-text">Task name</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="input input-bordered" />
                @error('name')
                    <span class="mt-1 text-sm text-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control">
                <label class="label" for="description"><span class="label-text">Description</span></label>
                <textarea name="description" id="description" rows="5" class="textarea textarea-bordered">{{ old('description') }}</textarea>
                @error('description')
                    <span class="mt-1 text-sm text-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="form-control">
                    <label class="label" for="status"><span class="label-text">Status</span></label>
                    <select name="status" id="status" class="select select-bordered">
                        <option value="not started" @selected(old('status') === 'not started')>Not started</option>
                        <option value="doing" @selected(old('status') === 'doing')>In progress</option>
                        <option value="done" @selected(old('status') === 'done')>Done</option>
                    </select>
                    @error('status')
                        <span class="mt-1 text-sm text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control">
                    <label class="label" for="priority"><span class="label-text">Priority</span></label>
                    <select name="priority" id="priority" class="select select-bordered">
                        <option value="low" @selected(old('priority') === 'low')>Low</option>
                        <option value="medium" @selected(old('priority') === 'medium')>Medium</option>
                        <option value="high" @selected(old('priority') === 'high')>High</option>
                    </select>
                    @error('priority')
                        <span class="mt-1 text-sm text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control">
                    <label class="label" for="startTime"><span class="label-text">Start time</span></label>
                    <input type="date" name="startTime" id="startTime" value="{{ old('startTime') }}"
                        class="input input-bordered" />
                    @error('startTime')
                        <span class="mt-1 text-sm text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control">
                    <label class="label" for="endTime"><span class="label-text">End time</span></label>
                    <input type="date" name="endTime" id="endTime" value="{{ old('endTime') }}"
                        class="input input-bordered" />
                    @error('endTime')
                        <span class="mt-1 text-sm text-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-ghost" href="{{ route('tasks.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
