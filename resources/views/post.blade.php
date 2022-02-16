@extends('layouts.main')

@section('container')
    

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
             <h2 class="mb-4">{{ $post->title }}</h2>   

             <div class="mb-3">
                  By. <a href="/posts?author={{ $post->author->username }} " class="text-decoration-none"> {{ $post->author->name }} </a> - <strong><a href="/posts?category={{ $post->category->slug }}">{{ $post->category->name }}</a></strong>
             </div>

             @if($post->image)
              <div style="max-height:400px; overflow:hidden;">
                <!-- jika ada file image didalam tabel --> 
                  <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
              </div>
             @else
              <!-- jika tidak ada, maka gunakan image default -->
                <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}"alt="$post->category->name" class="img-fluid mt-3">
             @endif

               <article class="my-3 fs-5">
                 <p class="mt-3">{!! $post->body !!}</p>
               </article>

                    <a href="/posts" class="btn btn-primary"><span data-feather="arrow-left-circle"></span> Back to post</a>
             
        </div>
    </div>
</div>

@endsection()




