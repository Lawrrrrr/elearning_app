@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header mb-md-4 text-center">
            <h2>My Categories</h2>
            <a href="{{ route('categories.create') }}" class="btn btn-primary mt-md-3 mb-md-2">Add Category</a>
        </div>
        <div class="row">
            <table class="table text-center">
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
                                    <a href="#" class="btn btn-primary ml-md-2">Add Word</a>
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