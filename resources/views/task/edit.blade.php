@extends("layouts.app")
@section('title')
    Task create
@endsection
@section('header')
    Task create
@endsection
@section('content')
    <form action="{{route('tasks.update', $task)}}" method="post">
        @csrf
        @method('put')
        <label for="">TaskName</label>
        <input class="form-control" type="text" name="name" value="{{$task->name}}">
        <label for="">Description</label>
        <textarea class="form-control" name="description" id="" cols="30" rows="10">
            {{$task->description}}
        </textarea>
        <label for="">Status</label>
        <select class="form-control" name="status" id="">
            <option value="not started" {{$task->status == 'not stated' ? 'selected' : ''}}>Not started</option>
            <option value="doing" {{$task->status == 'doing' ? 'selected' : ''}}>In progress</option>
            <option value="done" {{$task->status == 'done' ? 'selected' : ''}}>Done</option>
        </select>
        <label for="">Priority</label>
        <select class="form-control" name="priority" id="">
            <option value="low" {{$task->status == 'low' ? 'selected' : ''}}>Low</option>
            <option value="medium" {{$task->status == 'medium' ? 'selected' : ''}}>Medium</option>
            <option value="high" {{$task->status == 'high' ? 'selected' : ''}}>High</option>
        </select>
        <label for="">StartTime</label>
        <input class="form-control" type="date" name="startTime" value="startTime">
        <label for="">EndTime</label>
        <input class="form-control" type="date" name="endTime" value="endTime">
        <input class="btn btn-outline-primary" type="submit" value="Update">
    </form>
    <a class="btn btn-outline-primary" href="{{route('tasks.index')}}">Back</a>
@endsection
