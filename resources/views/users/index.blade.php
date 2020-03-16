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
                            <span class="px-3"><a href="">{{ $user->firstname . ' ' . $user->lastname }}</a></span>
                            <a href="#" class="btn btn-primary text-right ml-auto" 
                            style="visibility: {{ $user->id == auth()->user()->id ? 'hidden' : ''}}">Follow</a>             
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection