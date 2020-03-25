@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="page-header mb-md-4">
            <h2>Categories</h2>
        </div>
        @if (count($categories) == 0)
            <div class="message-header">
                <h2 class="text-danger text-center">No Categories available to take</h2>
            </div>
        @else
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-6 mb-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ $category->title }}</h5>
                            </div>
                            <div class="card-body">
                                <p>
                                    {{ $category->description }}
                                </p>
                                <div class="text-right">
                                    @if ($category->questions()->get()->count() == 0)
                                        <a href="#" class="btn btn-danger pl-md-4 pr-md-4">No questions in this category</a>
                                    @else
                                        @if (empty($category->checkIfTakenCategory($category->id, auth()->user()->id)->get()[0]->id))
                                            <a href="{{ route('categories.quizzes.index', ['category_id' => $category->id]) }}" class="btn btn-primary pl-md-4 pr-md-4">Answer Category</a> 
                                        @else
                                            <a href="{{ route('categories.results', ['category_id' => $category->id]) }}" class="btn btn-success pl-md-4 pr-md-4">Display Results</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-md-2">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection