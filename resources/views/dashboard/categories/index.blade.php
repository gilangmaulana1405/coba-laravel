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

  <div class="table-responsive col-lg-8">
    <a href="/dashboard/categories/create" class="btn btn-primary"><span data-feather="plus-circle"></span> Create New Category</a>
        <table class="table table-striped table-sm mt-3">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Category</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
             @foreach ($categories as $category)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $category->name }}</td>
              <td>
                  <a href="/dashboard/categories/{{ $category->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
                  <a href="/dashboard/categories/{{ $category->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                  <form action="/dashboard/categories/{{ $category->slug}}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure want to delete this post?')"><span data-feather="trash"></span></button>
                  </form>
              </td>
            </tr>
               @endforeach()
          </tbody>
        </table>
      </div>

@endsection()

