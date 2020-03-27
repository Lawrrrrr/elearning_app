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
                        <a href="{{ route('users.unfollow', ['followed_id' => $user->id]) }}" class="btn btn-danger text-right ml-auto pl-md-4 pr-md-4">Unfollow</a>
                    @else
                        <a href="{{ route('users.follow', ['followed_id' => $user->id]) }}" class="btn btn-primary text-right ml-auto pl-md-4 pr-md-4">Follow</a>
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
                    <div class="row m-md-3">
                        <img src="{{ asset('images/' . $user->avatar) }}" alt="avatar-pic" class="icon-avatar float-left mr-md-4">
                        <p>
                            {{ $user->firstname }} learned 20 of 20 words in <a href="http://">Nature Words</a><br />
                            <span class="text-muted">2 days ago</span>
                        </p>
                    </div>
                    <div class="row m-md-3">
                        <img src="{{ asset('images/' . $user->avatar) }}" alt="avatar-pic" class="icon-avatar float-left mr-md-4">
                        <p>
                            {{ $user->firstname }} learned 10 of 20 words in <a href="http://">Techno Words</a><br />
                            <span class="text-muted">3 days ago</span>
                        </p>
                    </div>
                    <div class="row m-md-3">
                        <img src="{{ asset('images/' . $user->avatar) }}" alt="avatar-pic" class="icon-avatar float-left mr-md-4">
                        <p>
                            {{ $user->firstname }} followed <a href="http://">James</a><br />
                            <span class="text-muted">12 days ago</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection