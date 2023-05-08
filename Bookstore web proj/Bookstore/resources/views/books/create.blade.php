@extends('layouts.app')

@section('content')
<body>
    <div class="container">
        <center><h1>Create Book</h1></center>
        <form action="{{ route('books.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title"><h3>Title</h3></label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <p></p>
            <div class="form-group">
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
                                <option value="{{ $author->id }}">
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
            </div>
            <p></p>
            <div class="form-group">
                <label for="genre_choice"><h3>Genre</h3></label>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">
                    <h5>Choose or create a genre:</h5>
                    </label>
                    <div>
                        <input type="radio" id="existing_genre" name="genre_choice" value="existing_genre" checked>
                        <label class="inline-block font-bold" for="existing_genre">-Choose existing genre:</label>
                        <select name="genre_id" id="genre_id" class="border rounded py-2 px-3 ml-2">
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}">
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
                </div>
            </div>

            <div class="form-group">
                <label for="publication_date"><h3>Publication Date:</h3></label>
                <input class="border rounded py-2 px-3" type="date" name="publication_date" id="publication_date" required>
            </div>
            
            <p></p>
            <button type="submit" class="btn btn-success">Create Book</button>
        </form>
    </div>
</body>
@endsection
