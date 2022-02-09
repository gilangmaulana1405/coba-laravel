@extends('layouts.main')

@section('container')

<div class="row justify-content-center">
    <div class="col-lg-4">

        <!-- alert flash success -->
        @if(session()->has('success'))
       <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
                {{ session('success') }}
            </div>
        </div>
        <!-- alert flash failed -->
        @elseif(session()->has('failed'))
         <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
               {{session('failed')}}
            </div>
        </div>
        @else
        @endif  

        <main class="form-signin">
                <h1 class="h3 mb-4 fw-normal text-center">Please Login</h1>
            <form action="/login" method="post">

                @csrf

                <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" value=" {{ old('email') }} " autofocus >
                    <label for="email">Email address</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Login</button>
            </form>

            <small class="d-block mt-3 text-center">Not registered? <a href="/register">Register Now!</a></small>
        </main>
    </div>
</div>

@endsection