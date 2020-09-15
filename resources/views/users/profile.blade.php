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
                    <img src="{{ asset('images/'. $user->avatar) }}" alt="avatar-pic" class="card-img-top">
                </div>
                <div class="card-header">
                    <h3>{{ $user->firstname . " " . $user->lastname }}</h3>
                    <h5 class="text-secondary">User Type: {{ ucfirst($user->user_type) }}</h5>
                    @if (auth()->user()->isFollowing($user->id))
                        <a href="{{ route('users.unfollow', ['followed_id' => $user->id]) }}" class="btn btn-danger text-right ml-auto pl-md-4 pr-md-4" 
                        style="visibility: {{ $user->id == auth()->user()->id ? 'hidden' : ''}}">Unfollow</a>
                    @else
                        <a href="{{ route('users.follow', ['followed_id' => $user->id]) }}" class="btn btn-primary text-right ml-auto pl-md-4 pr-md-4" 
                        style="visibility: {{ $user->id == auth()->user()->id ? 'hidden' : ''}}">Follow</a>
                    @endif
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
                    @if (auth()->user()->isFollowing($user->id))
                        @if (count($user->activities) == 0)
                            <div class="text-center">
                                <h3 class="text-danger">This user has no activities yet!</h3>
                            </div>
                        @else
                            @foreach ($user->activities->sortByDesc('updated_at') as $activity)
                                <div class="row m-md-3">
                                    <img src="{{ asset('images/' . $user->avatar) }}" alt="avatar-pic" class="icon-avatar float-left mr-md-4">
                                    @if ($activity->action_type ==  "learn")
                                        <p>
                                            {{ $user->firstname . " " . $user->lastname }} {{ $activity->action_type }}ed  
                                            <a href="#">
                                            {{ $user->lessonTaken($activity->action_id)->category()->get()[0]->title }}</a><br />
                                            <span class="text-muted">{{ $activity->updated_at->diffForHumans() }}</span>
                                        </p>
                                    @else
                                        <p>
                                            {{ $user->firstname . " " . $user->lastname }} 
                                            {{ $activity->action_type }}ed  <a href="{{ route('users.show', ['user_id' => $activity->action_id]) }}">
                                            {{ $activity->followedUser()->firstname . " " . $activity->followedUser()->lastname }}</a><br />
                                            <span class="text-muted">{{ $activity->updated_at->diffForHumans() }}</span>
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    @else
                        <div class="text-center">
                            <h3 class="text-danger">You are not following this user!</h3>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection