@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h2>Edit Question: {{ $question->title }}</h2>
                <a href="{{ route('categories.questions.index', ['id' => $category->id]) }}" class="btn btn-secondary pl-md-4 pr-md-4 m-md-2">Return</a>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.questions.update', ['category_id' => $category->id, 'question_id' => $question->id]) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="word"><h4>Question</h4></label>
                            <input type="text" name="title" class="form-control" value="{{ $question->title }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="choice"><h4>Choices</h4></label>
                            @for ($i = 1; $i <= count($words); $i++)
                                <div class="input-group mb-md-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="radio" name="answer" id="{{ 'choice' . $i}}" value="{{ 'choice' . $i}}" {{ $words[$i-1]->is_correct == 1 ? 'checked' : '' }} required>
                                        </div>
                                    </div>
                                    <input type="text" name="{{ 'choice' . $i}}" class="form-control" value="{{ $words[$i-1]->option }}" required>
                                </div>
                            @endfor
                            <button type="submit" class="btn btn-primary form-control mt-md-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
