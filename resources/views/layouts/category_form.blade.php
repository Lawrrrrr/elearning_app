<div class="mt-md-3">
    <form action="{{ empty($category) ? route('categories.store') : route('categories.update', ['id' => $category->id]) }}" method="post">
        @if (!empty($category))
            @method('PUT')
        @endif
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ empty($category)  ? "" : $category->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" cols="30" rows="10" class="form-control" required>{{ empty($category) ? "" : $category->description }}</textarea>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary text-center pl-md-5 pr-md-5">Submit</button>
        </div>
    </form>
</div>