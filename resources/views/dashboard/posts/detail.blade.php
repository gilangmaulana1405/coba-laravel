@extends('dashboard.layouts.main')

@section('container')
  
<div class="container">
    <div class="row my-5">
        <div class="col-lg-8">
             <h2 class="mb-4">{{ $post->title }}</h2>   

             <a href="/dashboard/posts" class="btn btn-success  btn-sm"><span data-feather="arrow-left"></span> Back to all my posts</a>
             <a href="/dashboard/posts" class="btn btn-warning  btn-sm"><span data-feather="edit"></span> Edit</a>
             <form action="/dashboard/posts/{{ $post->slug}}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')"><span data-feather="trash"></span> Delete</button>
             </form>

               <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}"alt="$post->category->name" class="img-fluid mt-3">

               <article class="my-3 fs-5">
                 <p class="mt-3">{!! $post->body !!}</p>
               </article>

                <!-- <a href="/posts" class="btn btn-primary"><span data-feather="arrow-left-circle"></span> Back to post</a> -->
             
        </div>
    </div>
</div>

@endsection()




