@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @foreach ($questions as $question)
                @php
                    $words = $question->words()->get();
                    $index = 1;
                @endphp
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Question: {{ $question->title }}</h3>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('categories.quizzes.answer', ['category_id' => $category->id, 'lesson_id' => $lesson, 'question_id' => $question->id, 'page' => $questions->currentPage()]) }}" method="post">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md form-group">
                                <label for="choice"><h4>Choices</h4></label>
                                @foreach($words as $word)
                                    <div class="input-group mb-md-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" name="answer" id="choice{{ $index }}" value="choice{{ $index }}" required>
                                            </div>
                                        </div>
                                        <input type="text" name="choice{{ $index }}" class="form-control" value="{{ $word->option }}" readonly>
                                    </div>
                                    @php
                                        $index++;
                                    @endphp
                                @endforeach
                                <button type="submit" class="btn btn-primary form-control mt-md-4">Answer</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
