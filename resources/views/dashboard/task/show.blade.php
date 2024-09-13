@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>{{ $task->title }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">{!! $task->description !!}</div>
        </div>
        <div class="row">
            <div class="col-md-12">Status: {{ $task->status }}</div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">Created at: {{ $task->created_at }}</div>
        </div>
        <hr>
        <h2>Comments</h2>
        @foreach($comments as $comment)
            <p>{{$comment->created_at}}</p>
            <p>{!!  $comment->content !!}</p>
            <div class="row">
                <form action="{{ route('task_comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
            <hr>
        @endforeach
        <hr>
        <form action="{{route('task_comment.store')}}" method="post">
            @csrf
            <input type="hidden" name="task_id" value="{{ $task->id }}">
            <div class="row mt-2">
                <div class="col-md-12">
                    <label>Message</label>
                    <textarea class="form-control" name="content"></textarea>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-2">
                    <button class="btn btn-primary">Send</button>
                </div>
            </div>
        </form>
        <div class="row mt-3">
            <div class="col-md-2"><a class="btn btn-warning" href="{{route('dashboard')}}">Back to list</a></div>
        </div>
    </div>
@endsection
