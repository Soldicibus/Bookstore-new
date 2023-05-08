@extends('layouts.app')

@section('content')


<center><h1>Books</h1>
    @if(Auth::check() && Auth::user()->role_id === 2)
        <a href="{{ route('books.create') }}" class="btn btn-primary">Add Book</a>
        
        <a href="{{ route('books.export') }}" class="btn btn-info" style="margin-left: 10px;">Export Books</a>
    @endif</center>
    <br><br>
    <p></p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">View</a>
                        @if(Auth::check() && Auth::user()->role_id === 2)
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-success" style="margin-left: 10px;">Edit</a>
                        
                            <button type="button" class="btn btn-danger" style="margin-left: 10px;" data-toggle="modal" data-target="#deleteModal{{$book->id}}">
                                Delete
                            </button>
                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$book->id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{$book->id}}">Confirm Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this book?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endsection
