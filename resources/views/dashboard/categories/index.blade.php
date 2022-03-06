@extends('dashboard.layouts.main')

@section('container')
 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Post Categories</h1>
 </div>

 @if(session()->has('success'))
 <div class="alert alert-success d-flex align-items-center col-lg-8" role="alert">
   <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
      <div>
         {{ session('success') }}
      </div>       
 </div>
 @endif()

 <a href="/dashboard/categories/create" class="btn btn-primary"><span data-feather="plus-circle"></span> Create New Category</a>

      @foreach ($categories as $category)
      <!-- card category -->
      <div class="card col-md-6 mt-3">
        <div class="card-body">
          <div class="row">
            <div class="col-8">
               <h5 class="card-title">{{ $category->name }}</h5>
            </div>
            <div class="col-4">
              <!-- tampilkan link yang mengarah ke view show -->
              <a href="/dashboard/categories/{{ $category->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
              <a href="/dashboard/categories/{{ $category->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>  
              <form action="/dashboard/categories/{{ $category->slug}}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure want to delete this post?')"><span data-feather="trash"></span></button>
              </form> 
            </div>
          </div>
        </div>
      </div>
       @endforeach()
      
      <!-- end card category -->

@endsection()

