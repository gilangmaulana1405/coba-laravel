@extends('dashboard.layouts.main')

@section('container')

<h1 class="mt-5">{{ $category->name }}</h1>
<p class="lead">{{ $category->description }}</p>

@endsection()