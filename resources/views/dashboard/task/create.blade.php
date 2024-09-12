@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create new task</h2>
        <form action="{{route('task.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label>Title</label>
                    <input class="form-control" name="title">
                </div>
                <div class="col-md-6">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        @foreach($statuses as $status)
                            <option value="{{$status->value}}">{{$status->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Team</label>
                    <select class="form-control" name="team_id">
                        @foreach($teams as $team)
                            <option value="{{$team->id}}">{{$team->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-2">
                    <button class="btn btn-primary">Save</button>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-warning" href="{{route('dashboard')}}">Cancel</a>
                </div>
            </div>
        </form>

    </div>
@endsection
