@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card text-center">
                <div class="card-header">
                    <h2>{{ $category->title }} Results</h2>
                    <h3 class="text-info">Score: {{ count($lesson->correctAnswers()->get()) . "/" . count($lesson->quizzes()->get())}}</h3>
                    <div class="btngroup mt-md-3">
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary ml-md-2">Return</a>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Correct Answer</th>
                            <th>User's Answer</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach ($questions as $question)
                            <tr>
                                <td>{{ $question->title }}</td>
                                @foreach ($question->correctAnswers()->get() as $word)
                                    <td>{{ $word->option }}</td>
                                    @foreach ($question->userAnswers($lesson->id)->get() as $quiz)
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
