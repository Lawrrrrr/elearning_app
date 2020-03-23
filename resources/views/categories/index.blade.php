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
                                <div class="text-right">
                                    @if (empty($category->checkIfTakenCategory($category->id, auth()->user()->id)->get()[0]->id))
                                        <a href="{{ route('categories.quizzes.index', ['category_id' => $category->id]) }}" class="btn btn-primary pl-md-4 pr-md-4">Answer Category</a>
                                    @else
                                        <a href="{{ route('categories.results', ['category_id' => $category->id]) }}" class="btn btn-success pl-md-4 pr-md-4">Display Results</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection