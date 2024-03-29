@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 text-center">
            <div class="card">
                <div class="m-md-3">
                    <img src="{{ asset('images/'. auth()->user()->avatar) }}" alt="avatar-pic" class="card-img-top rounded avatar-picture">
                </div>
                <div class="card-header">
                    <h3>{{ auth()->user()->firstname . " " . auth()->user()->lastname }}</h3>
                    <h5 class="text-secondary">User Type: {{ ucfirst(auth()->user()->user_type) }}</h5>
                    <a href="{{ route('users.edit', ['user_id' => auth()->user()->id]) }}" class="btn btn-warning mt-md-2">Edit Profile</a>
                </div>
                <div class="card-body">
                    <a href="#">Words Learned</a><br />
                    <a href="#">Categories learned</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header"><h3>Activities</h3></div>
                <div class="card-body">
                    @if (count(auth()->user()->activities) == 0)
                        <div class="text-center">
                            <h3 class="text-danger">You have no activities yet!</h3>
                        </div>
                    @else
                        @foreach (auth()->user()->activities->sortByDesc('updated_at') as $activity)
                            <div class="row m-md-3">
                                <img src="{{ asset('images/' . auth()->user()->avatar) }}" alt="avatar-pic" class="icon-avatar float-left mr-md-4">
                                @if ($activity->action_type ==  "learn")
                                    <p>
                                        You {{ $activity->action_type }}ed  <a href="{{ route('categories.results', ['category_id' => auth()->user()
                                        ->lessonTaken($activity->action_id)->category_id]) }}">{{ auth()->user()->lessonTaken($activity->action_id)->category()->get()[0]->title }}</a><br />
                                        <span class="text-muted">{{ $activity->updated_at->diffForHumans() }}</span>
                                    </p>
                                @else
                                    <p>
                                        You {{ $activity->action_type }}ed  <a href="{{ route('users.show', ['user_id' => $activity->action_id]) }}">
                                            {{ $activity->followedUser()->firstname . " " . $activity->followedUser()->lastname }}</a><br />
                                        <span class="text-muted">{{ $activity->updated_at->diffForHumans() }}</span>
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
