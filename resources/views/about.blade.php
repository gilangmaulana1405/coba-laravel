
        @extends('layouts.main')

        @section('container')
        <h1>Halaman About</h1>
        <p> {{ $name }} </p>
        <p> {{ $email }} </p>
        <img src="img/{{ $image }}" alt="{{ $name }}" width="200">
        <p>halo nama saya {{ $name }}. Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis ducimus nam exercitationem repellat corrupti nisi asperiores expedita, officia iure consectetur inventore nostrum adipisci at optio dolor maxime voluptatem, eveniet similique?</p>
        @endsection()


