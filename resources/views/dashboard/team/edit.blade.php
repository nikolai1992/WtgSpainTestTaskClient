@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create new team</h2>
        <form action="{{route('team.update', $team->id)}}" method="post">
            {{ method_field('PUT') }}
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label>Name</label>
                    <input class="form-control" name="name" value="{{$team->name}}">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-2">
                    <button class="btn btn-primary">Save</button>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-warning" href="{{route('teams.index')}}">Cancel</a>
                </div>
            </div>
        </form>

    </div>
@endsection
