@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (auth()->user()->user_type == "admin")
                @if (!empty($category))
                    <div class="col-md-6">
                        <h4>Edit Category</h4>
                        @include('layouts.category_form')
                    </div>
                @else
                    <h1 class="text-danger text-center">Category not found!</h1>
                @endif
            @endif
        </div>
    </div>
@endsection
