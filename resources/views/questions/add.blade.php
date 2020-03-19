@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h2>Add Questions for Category #{{ $category->id . ": " . $category->title }}</h2>
                <a href="{{ route('categories.questions.index', ['category_id' => $category->id]) }}" class="btn btn-secondary pl-md-4 pr-md-4 m-md-2">Return</a>
            </div>
            <div class="card-body">
            <form action="{{ route('categories.questions.store', ["category" => $category->id]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="word"><h4>Question</h4></label>
                        <input type="text" name="title" class="form-control" placeholder="Enter a word" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="choice"><h4>Choices</h4></label>
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="input-group mb-md-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" name="answer" id="{{ 'choice'. $i }}" value="{{ 'choice'. $i }}" required>
                                    </div>
                                </div>
                                <input type="text" name="{{ 'choice'. $i }}" class="form-control" placeholder="Choice" required>
                            </div>
                        @endfor
                        <button type="submit" class="btn btn-primary form-control mt-md-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
