@extends('layouts.app')

@section('content')
    <div class="container mt-md-4 p-md-5 rounded" style="background-color: #DCDCDC;">
        <div class="row">
            <div class="col-md-10">
                <div class="change-avatar">
                    <div class="header mb-md-4">
                        <h3>Upload New Avatar</h3>
                    </div>
                    <div class="avatar-img float-md-left mr-md-3">
                        <img src="{{ asset('images/' . auth()->user()->avatar) }}" alt="" style="height: 125px; width: 125px;">
                    </div>                  
                    <form action="{{ route('home.upload_avatar') }}" method="post" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <input type="file" name="avatar" id="">
                        </div>
                        <input type="submit" value="Save" class="btn btn-primary">
                        <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection