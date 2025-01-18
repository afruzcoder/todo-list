@extends("layouts.app")
@section('title')
    Task create
@endsection
@section('header')
    Task create
@endsection
@section('content')
    <form action="{{route('tasks.store')}}" method="post">
        @csrf
        <label for="">TaskName</label>
        <input class="form-control" type="text" name="name" id="">
        <label for="">Description</label>
        <textarea class="form-control" name="description" id="" cols="30" rows="10">

        </textarea>
        <label for="">Status</label>
        <select class="form-control" name="status" id="">
            <option value="not started">Not started</option>
            <option value="doing">In progress</option>
            <option value="done">Done</option>
        </select>
        <label for="">Priority</label>
        <select class="form-control" name="priority" id="">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
        <label for="">StartTime</label>
        <input class="form-control" type="date" name="startTime" id="">
        <label for="">EndTime</label>
        <input class="form-control" type="date" name="endTime" id="">
        <input class="btn btn-outline-primary" type="submit" value="Save">
    </form>
    <a class="btn btn-outline-primary" href="{{route('tasks.index')}}">Back</a>
@endsection
