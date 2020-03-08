@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 text-center">
            <div class="card">
                <div class="card-img-top img-fluid p-md-3">
                    <img src="{{ asset('images/nofaces.png') }}" alt="" srcset="" class="">
                </div>
                <div class="card-header">
                    <h3>{{ auth()->user()->firstname . " " . auth()->user()->lastname}}</h3>
                    <h4>{{ auth()->user()->user_type }}</h4>
                </div>

                <div class="card-body">
                    <a href="http://">Learned 20 words</a><br />
                    <a href="http://">Learned 10 lessons</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header"><h3>Activities</h3></div>
                <div class="card-body">
                    <div class="row m-md-3">
                        <img src="{{ asset('images/nofaces.png') }}" alt="" srcset="" class="icon-avatar float-left mr-md-4">
                        <p>
                            You learned 20 of 20 words in <a href="http://">Nature Words</a><br />
                            <span class="text-muted">2 days ago</span>
                        </p>
                    </div>
                    <div class="row m-md-3">
                        <img src="{{ asset('images/nofaces.png') }}" alt="" srcset="" class="icon-avatar float-left mr-md-4">
                        <p>
                            You learned 10 of 20 words in <a href="http://">Techno Words</a><br />
                            <span class="text-muted">3 days ago</span>
                        </p>
                    </div>
                    <div class="row m-md-3">
                        <img src="{{ asset('images/nofaces.png') }}" alt="" srcset="" class="icon-avatar float-left mr-md-4">
                        <p>
                            You followed <a href="http://">James</a><br />
                            <span class="text-muted">12 days ago</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
