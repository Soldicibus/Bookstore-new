@extends('layouts.app')

@section('content')
    <h1>Favorites</h1>
    @if($books->isNotEmpty())
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Publication Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>{{ $book->genre->name }}</td>
                    <td>{{ $book->publication_date }}</td>
                    <td>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">View</a>
                        <form action="{{ route('favorites.destroy', $book->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No favorite books found.</p>
    @endif
@endsection
