@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/users-index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h3 class="mb-md-3">Users</h3>
        <div class="row justify-content-center">
            @foreach ($users as $user)
                <div class="col-md-6 mb-md-3">
                    <div class="card">
                        <div class="card-body align-items-center d-flex">
                            <img src="{{ asset('images/' . $user->avatar) }}" class="icon-avatar img-fluid rounded">
                            <span class="px-3"><a href="{{ route('users.show', ['user_id'=> $user->id]) }}">{{ $user->firstname . ' ' . $user->lastname }}</a></span>
                            @if (auth()->user()->isFollowing($user->id))
                                <a href="{{ route('users.unfollow', ['followed_id' => $user->id]) }}" class="btn btn-danger text-right ml-auto pl-md-4 pr-md-4" 
                                {{ auth()->user()->id == $user->id ? 'hidden' : '' }}>Unfollow</a>
                            @else
                                <a href="{{ route('users.follow', ['followed_id' => $user->id]) }}" class="btn btn-primary text-right ml-auto pl-md-4 pr-md-4"
                                {{ auth()->user()->id == $user->id ? 'hidden' : '' }}>Follow</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection