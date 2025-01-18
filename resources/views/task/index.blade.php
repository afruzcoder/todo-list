@extends("layouts.app")
@section('title')
    To-do list
@endsection
@section('header')
    Tasks
@endsection
@section('content')
    <table class="table table-striped">
        <tr>
            <th>#</th>
            <th>Task</th>
            <th>Description</th>
            <th>Status</th>
            <th>Priority</th>
            <th>StartTime</th>
            <th>EndTime</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Action</th>
        </tr>
        @foreach($tasks as $task)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$task->name}}</td>
            <td>{{$task->description}}</td>
            <td>{{$task->status}}</td>
            <td>{{$task->priority}}</td>
            <td>{{$task->startTime}}</td>
            <td>{{$task->endTime}}</td>
            <td>{{$task->created_at}}</td>
            <td>{{$task->updated_at}}</td>
            <td>
                <a href="{{route('tasks.show', $task)}}" class="btn btn-outline-warning btn-sm">Show</a>
                <a href="{{route('tasks.edit', $task)}}" class="btn btn-outline-primary btn-sm">Edit</a>
                <form action="{{route('tasks.destroy', $task)}}" method="post">
                    @csrf
                    @method('delete')
                    <input class="btn btn-outline-danger btn-sm" type="submit" value="Delete">
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <a href="{{route('tasks.create')}}" class="btn btn-outline-primary">Add</a>
@endsection
