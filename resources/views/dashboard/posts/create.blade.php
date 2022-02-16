@extends('dashboard.layouts.main')

@section('container')

 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Posts</h1>
 </div>

<div class="col-lg-8">
    <!-- diarahkan ke store method di controller langsung tanpa ubah route di web.php -->
     <form action="/dashboard/posts" method="post" enctype="multipart/form-data">
         @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" autofocus value="{{ old('title') }}">
            @error('title')
             <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
            @error('slug')
             <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="category_id">
                @foreach($categories as $category)
                    <!-- membuat select input tetap aktif ketika submit form gagal -->
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach()
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Post Image</label>
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
             @error('image')
             <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            @error('body')
               <p class="text-danger"> {{ $message }} </p>
            @enderror
            <input id="body" type="hidden" name="body" value=" {{ old('body') }} ">
            <trix-editor input="body"></trix-editor>
        </div>

        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>

<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function(){
        // ngefetch dari dashboardController
        fetch('/dashboard/posts/checkSlug?title=' + title.value) 
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });

    // menghilangkan file toolbar trix-editor
    document.addEventListener('trix-file-accept', function(event) {
        event.preventDefault();
    });

</script>

@endsection()

