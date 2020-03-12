@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (auth()->user()->isAdmin())
                <div class="col-md-6">
                    <h4>Add a Category</h4>
                    <div class="mt-md-3">
                        <form action="{{ route('categories.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="" class="">Title</label>
                                <input type="text" name="title" class="form-control" minlength="2" required>
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control" minlength="10" required></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary text-center pl-md-5 pr-md-5">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
