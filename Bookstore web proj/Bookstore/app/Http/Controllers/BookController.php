<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use League\Csv\Writer;

class BookController extends Controller
{
    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('books.create', compact('authors', 'genres'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'publication_date' => 'required|date',
            'author_choice' => 'required',
            'new_author_name' => 'required_if:author_choice,new_author',
            'author_id' => 'required_if:author_choice,existing_author',
            'genre_choice' => 'required',
            'genre_id' => 'required_if:genre_choice,existing_genre',
            'new_genre_name' => 'required_if:genre_choice,new_genre',
        ]);
    
        $book = new Book();
        $book->title = $request->input('title');
        $book->publication_date = $request->input('publication_date');
    
        if ($request->input('genre_choice') === 'new_genre') {
            $genre = new Genre();
            $genre->name = $request->input('new_genre_name');
            $genre->save();
            $book->genre_id = $genre->id;
        } else {
            $book->genre_id = $request->input('genre_id');
        }
    
        if ($request->input('author_choice') === 'new_author') {
            $author = new Author();
            $author->name = $request->input('new_author_name');
            $author->save();
            $book->author_id = $author->id;
        } else {
            $book->author_id = $request->input('author_id');
        }
    
        $book->save();
    
        return redirect()->route('books.show', $book->id);
    }
    
    

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }
    public function edit(Book $book)
    {
        $authors = Author::all();
        $genres = Genre::all();

        return view('books.edit', compact('book', 'authors', 'genres'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required_if:author_choice,existing_author',
            'genre_id' => 'required',
            'publication_date' => 'required|date',
        ]);

        $book->title = $request->input('title');
        $book->genre_id = $request->input('genre_id');
        $book->publication_date = $request->input('publication_date');

        if ($request->input('author_choice') == 'existing_author') {
            $book->author_id = $request->input('author_id');
        } else {
            $author = new Author();
            $author->name = $request->input('new_author_name');
            $author->save();

            $book->author_id = $author->id;
        }
        // Create new genre if selected
        if ($request->genre_choice == 'new_genre') {
            $genre = Genre::create([
             'name' => $request->new_genre_name
            ]);
            $book->genre_id = $genre->id;
        }


        $book->save();

        return redirect()->route('books.show', ['book' => $book->id]);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index');
    }
    public function export()
    {
    // Fetch the books data
    $books = Book::all();

    // Create a new CSV file
    $csv = Writer::createFromString('');

    // Add the header row
    $csv->insertOne(['Title', 'Author', 'Genre', 'Publication Date']);

    // Add the data rows
    foreach ($books as $book) {
        $csv->insertOne([$book->title, $book->author->name, $book->genre->name, $book->publication_date]);
    }

    // Output the CSV file to the browser
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="books.csv"');
    echo $csv->getContent();
    }
}
