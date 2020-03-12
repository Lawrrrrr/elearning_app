@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header mb-md-4">
            <h2>Categories</h2>
        </div>
        @if ($categories->count() == 0)
            <div class="message-header">
                <h2 class="text-danger text-center">No categories available to take</h2>
            </div>
        @else
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-6 mb-md-4">
                        <div class="card">
                            <div class="card-header">
                                {{ $category->title }}
                            </div>
                            <div class="card-body">
                                <p>
                                    {{ $category->description }}
                                </p>
                                <div class="button-group text-right">
                                    <a href="#" class="btn btn-primary pl-md-4 pr-md-4">Begin</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection