@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <center><h1>Edit Book</h1></center>
        <p></p>
        <form method="POST" action="{{ route('books.update', $book->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="title">
                    <h3>Title</h3>
                </label>
                <input class="form-control" type="text" name="title" id="title" value="{{ $book->title }}" required>
            </div>

            <label for="author_id"><h3>Author</h3></label>
                <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">
                    <h5>Choose or create an author:</h5>
                </label>
                <div>
                    <input type="radio" id="existing_author" name="author_choice" value="existing_author" checked>
                    <label class="inline-block font-bold" for="existing_author">-Choose existing author:</label>
                    <select name="author_id" id="author_id" class="border rounded py-2 px-3 ml-2">
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" {{ $author->id == $book->author_id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-2">
                    <input type="radio" id="new_author" name="author_choice" value="new_author">
                    <label class="inline-block font-bold" for="new_author">-Create new author:</label>
                    <input class="border rounded py-2 px-3 ml-2" type="text" name="new_author_name" id="new_author_name">
                </div>
            </div>

            <div class="mb-4">
            <label for="genre_choice"><h3>Genre</h3></label>
                <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">
                <h5>Choose or create a genre:</h5>
                </label>
                <div>
                    <input type="radio" id="existing_genre" name="genre_choice" value="existing_genre" checked>
                    <label class="inline-block font-bold" for="existing_genre">-Choose existing genre:</label>
                    <select name="genre_id" id="genre_id" class="border rounded py-2 px-3 ml-2" required>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ $genre->id == $book->genre_id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-2">
                    <input type="radio" id="new_genre" name="genre_choice" value="new_genre">
                    <label class="inline-block font-bold" for="new_genre">-Create new genre:</label>
                    <input class="border rounded py-2 px-3 ml-2" type="text" name="new_genre_name" id="new_genre_name">
                </div>
            <p></p>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="publication_date">
                <h3>Publication Date:</h3>
                </label>
                <input class="border rounded py-2 px-3" type="date" name="publication_date" id="publication_date" value="{{ $book->publication_date }}" required>
            </div>
        </div>
            <div>
            <button type="submit" class="btn btn-success">Update Book</button>
            </div>
        </form>
    </div>
@endsection
