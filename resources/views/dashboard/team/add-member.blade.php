@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create new team</h2>
        <form action="{{route('team.addMemberRequest', $teamId)}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label>Member</label>
                    <select class="form-control" name="user_id">
                        @foreach($members as $member)
                            <option value="{{$member->id}}">{{$member->name}} {{$member->email}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-2">
                    <button class="btn btn-primary">Save</button>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-warning" href="{{route('team.index')}}">Cancel</a>
                </div>
            </div>
        </form>

    </div>
@endsection
