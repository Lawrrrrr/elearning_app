@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="card">
            <div class="card-header">
                <h2>Category #{{ $category->id . ": " . $category->title }}</h2>
                <a href="{{ route('categories.questions.create', ['category' => $category]) }}" class="btn btn-primary mt-md-3 mb-md-2 mr-md-4">Add Question</a>
                <a href="{{ route('categories.admin') }}" class="btn btn-secondary mt-md-3 mb-md-2">Return</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        <tr>
                            <td>{{ $question->title }}</td>
                            <td>{{ $question->correctAnswer()->get()[0]->option }}</td>
                            <td>
                                <form action="{{ route('categories.questions.destroy', ['category_id' => $category->id, 'question_id' => $question->id]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('categories.questions.edit', ['category_id' => $category->id, 'question_id' => $question->id]) }}" class="btn btn-warning ml-md-2">Edit</a>
                                    <button type="submit" class="btn btn-danger ml-md-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
