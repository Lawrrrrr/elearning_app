@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                <h2>My Categories</h2>
                <a href="{{ route('categories.create') }}" class="btn btn-primary mt-md-3 mb-md-2">Create Category</a>
            </div>
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                {{ $category->title }}
                            </td>
                            <td>
                                {{ $category->description }}
                            </td>
                            <td>
                                <form action="{{ route('categories.destroy', ['id' => $category->id]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('categories.questions.index', ['id' => $category->id]) }}" class="btn btn-primary ml-md-2">Add Word</a>
                                    <a href="{{ route('categories.edit', ['id' => $category->id]) }}" class="btn btn-warning ml-md-2">Edit</a>
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
