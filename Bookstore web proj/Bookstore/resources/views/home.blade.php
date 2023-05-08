@extends('layouts.app')

@section('title', 'Bookstore')

@section('content')
    <div class="container-fluid px-0">
        <div class="row align-items-center justify-content-center mx-0" style="height: 100vh; position: relative;">
            <img src="{{ asset('images/books-background.jpg') }}" alt="Books Background" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; object-position: center;">
            <div class="col-lg-6 text-center" style="color: #FFFFFF; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); ">
                <h1 style="font-weight: bold">Welcome to the Bookstore</h1>
                <p></p>
                <p class="lead" style="font-weight: bold">Browse our selection of books and find your next read.</p>
                <a href="{{ route('books.index') }}" class="btn btn-primary btn-lg mt-3" style="color: #fff; border: 2px solid #fff;">Explore Books</a>
                @if (Auth::check())
                    <p></p>
                    <p class="lead" style="font-weight: bold">Or you can read your personal favorite books.</p>
                    <a href="{{ route('favorites.index') }}" class="btn btn-warning  btn-lg mt-3" style="color: #fff; border: 2px solid #fff;">Go to "My Favorites"</a>
                @endif
            </div>
        </div>
    </div>
@endsection
