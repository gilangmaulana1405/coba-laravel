@extends('dashboard.layouts.main')

@section('container')

 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Post</h1>
 </div>

<div class="col-lg-8">
    <!-- diarahkan ke store method di controller langsung tanpa ubah route di web.php -->
     <form method="post" action="/dashboard/posts/{{ $post->slug }}" enctype="multipart/form-data">
         @method('put')
         @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" autofocus 
            value="{{ old('title', $post->title) }}">
            @error('title')
             <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
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
                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach()
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Post Image</label>
            <input type="hidden" name="oldImage" value="{{ $post->image }}">
            @if($post->image)
            <!-- image yang baru -->
                <img src="{{ asset('storage/'.$post->image) }}" class="img-preview img-fluid mb-3 col-sm-6 d-block">
            @else
            <!-- image kosong -->
                <img class="img-preview img-fluid mb-3 col-sm-6">
            @endif
            
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
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
            <input id="body" type="hidden" name="body" value=" {{ old('body', $post->body) }} ">
            <trix-editor input="body"></trix-editor>
        </div>
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>

<script>
    // slug otomatis
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
    // end slug otomatis


     // image preview
    function previewImage(){
        // mengambil input file image
        const image = document.querySelector('#image');
        // mengambil gambar yang diupload
        const imgPreview = document.querySelector('.img-preview');
        // membuat image display block
        imgPreview.style.display = 'block';
        

        const ofReader = new FileReader();
        ofReader.readAsDataURL(image.files[0]);

        ofReader.onload = function(event){
            imgPreview.src = event.target.result;
        }
    }
    // end of image preview

</script>

@endsection()

