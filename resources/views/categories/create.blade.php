@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (Auth::user()->isAdmin())
                <div class="col-md-6">
                    <h4>Add a Category</h4>
                    @include('layouts.category_form')
                </div>
            @endif
        </div>
    </div>
@endsection
