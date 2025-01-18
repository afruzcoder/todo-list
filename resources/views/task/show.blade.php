@extends("layouts.app")
@section('title')
    To-do list
@endsection
@section('header')
    Task {{$task->id}}
@endsection
@section('content')
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <td>{{$task->name}}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{$task->description}}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{$task->status}}</td>
        </tr>
        <tr>
            <th>Priority</th>
            <td>{{$task->priority}}</td>
        </tr>
        <tr>
            <th>StartTime</th>
            <td>{{$task->startTime}}</td>
        </tr>
        <tr>
            <th>EndTime</th>
            <td>{{$task->endTime}}</td>
        </tr>
        <tr>
            <th>Created at</th>
            <td>{{$task->created_at}}</td>
        </tr>
        <tr>
            <th>Updated at</th>
            <td>{{$task->updated_at}}</td>
        </tr>
    </table>
    <a class="btn btn-outline-primary" href="{{route('tasks.index')}}">Back</a>
@endsection
