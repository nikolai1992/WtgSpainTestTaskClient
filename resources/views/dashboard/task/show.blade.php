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
        <div class="row mt-3">
            <div class="col-md-2"><a class="btn btn-warning" href="{{route('dashboard')}}">Back to list</a></div>
        </div>
    </div>
@endsection
