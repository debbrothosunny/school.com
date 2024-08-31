@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>Available Books</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Language</th>
                <th>Available Copies</th>
                <th>Return Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->book_title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->publisher }}</td>
                <td>{{ $book->language }}</td>
                <td>{{ $book->copies_available }}</td>
                <td>
                    @if($book->booked)
                        <button type="button" class="btn btn-secondary" disabled>Booked</button>
                    @else
                        <form action="{{ route('student.library.book') }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <input type="date" name="return_date" required>
                            <button type="submit" class="btn btn-primary">Book</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
