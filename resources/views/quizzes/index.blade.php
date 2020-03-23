@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header">
                    <h2>{{ $category->title }}</h2>
                </div>
                <div class="card-body">
                    <p>You are about to take this category</p>
                    <div class="btngroup mt-md-3">
                        <a href="{{ route('categories.quizzes.show', ['category_id' => $category->id, 'quiz_id' => $category->id]) }}" class="btn btn-primary mr-md-2">Begin Quiz</a>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary ml-md-2">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
