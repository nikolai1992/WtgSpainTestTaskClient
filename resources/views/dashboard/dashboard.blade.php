@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tasks list') }}</div>
                <div class="row">
                    <div class="col-md-3">
                        <a class="btn btn-primary" href="{{route('task.create')}}">Create new</a>
                    </div>

                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Task name</th>
                        <th>Status</th>
                        <th>Updated at</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{$task->title}}</td>
                            <td>{{$task->status}}</td>
                            <td>{{$task->updated_at}}</td>
                            <td>{{$task->created_at}}</td>
                            <td>
                                <a class="btn btn-success" href="{{route('task.show', $task->id)}}">Show</a>
                                <a class="btn btn-primary" href="{{route('task.edit', $task->id)}}">Edit</a>
                                <a class="btn btn-danger" href="{{route('task.destroy', $task->id)}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
