@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Teams</div>
                    <div class="row">
                        <div class="col-md-3">
                            <a class="btn btn-primary" href="{{route('team.create')}}">Create new</a>
                        </div>

                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Team members</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teams as $team)
                            <tr>
                                <td>{{$team->name}}</td>
                                <td>
                                    @foreach($team->team_members as $teamMember)
                                        <span>{{$teamMember->name}}</span>
                                        <a class="btn btn-danger" href="{{route('team.removeMemberRequest', ['teamId' => $team->id, 'userId' => $teamMember->id])}}">Remove</a><br>
                                    @endforeach
                                </td>
                                <td>
                                    <a class="btn btn-success" href="{{route('team.show', $team->id)}}">Show</a>
                                    <a class="btn btn-primary" href="{{route('team.edit', $team->id)}}">Edit</a>
                                    <a class="btn btn-primary" href="{{route('team.addMember', $team->id)}}">Add new member</a>
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
