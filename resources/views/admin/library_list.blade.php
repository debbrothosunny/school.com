@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>Library Books</h1>
    <a href="{{ route('libraries.create') }}" class="btn btn-primary mb-3">Add New Book</a>
    @if($books->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>ISBN</th>
                <th>Year</th>
                <th>Category</th>
                <th>Language</th>
                <th>Copies Available</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->book_title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->publisher }}</td>
                <td>{{ $book->isbn }}</td>
                <td>{{ $book->published_year }}</td>
                <td>{{ $book->category }}</td>
                <td>{{ $book->language }}</td>
                <td>{{ $book->copies_available }}</td>
                <td>{{ $book->status }}</td>
                <td>
                    <!-- Edit Button -->
                    <a href="{{ route('libraries.edit', $book->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <!-- Delete Button -->
                    <form action="{{ route('libraries.destroy', $book->id) }}" method="get" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this book?');">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No books available in the library.</p>
    @endif
</div>
@endsection
