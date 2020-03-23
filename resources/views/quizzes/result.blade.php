@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card text-center">
                <div class="card-header">
                    <h2>{{ $category->title }} Results</h2>
                    <h3 class="text-info">Score: {{ count($lesson->quizzes()->where('is_correct', 1)->get()) . "/" . count($lesson->quizzes()->get())}}</h3>
                    <div class="btngroup mt-md-3">
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary ml-md-2">Return</a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Correct Answer</th>
                            <th>User's Answer</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach ($questions as $question)
                            @php
                                $words = $question->words()->where('is_correct', 1)->get();
                                $quizzes = $question->quiz()->where('lesson_id', $lesson->id)->get();
                            @endphp
                            <tr>
                                <td>{{ $question->title }}</td>
                                @foreach ($words as $word)
                                    <td>{{ $word->option }}</td>
                                    @foreach ($quizzes as $quiz)
                                        <td class="{{ $quiz->is_correct == 1 ? "table-success" : "table-danger" }}">{{ $quiz->answer }}</td>
                                    @endforeach
                                @endforeach
                            </tr>
                        @endforeach   
        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
