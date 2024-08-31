@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Book</h1>
    <form action="{{ route('libraries.update', $books->id) }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="book_title">Book Title</label>
            <input type="text" class="form-control" id="book_title" name="book_title" value="{{ $books->book_title }}" required>
        </div>

        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ $books->author }}" required>
        </div>

        <div class="form-group">
            <label for="publisher">Publisher</label>
            <input type="text" class="form-control" id="publisher" name="publisher" value="{{ $books->publisher }}">
        </div>

        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $books->isbn }}" maxlength="20">
        </div>

        <div class="form-group">
            <label for="published_year">Published Year</label>
            <input type="number" class="form-control" id="published_year" name="published_year" value="{{ $books->published_year }}" min="1000" max="{{ date('Y') }}">
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $books->category }}">
        </div>

        <div class="form-group">
            <label for="language">Language</label>
            <input type="text" class="form-control" id="language" name="language" value="{{ $books->language }}" maxlength="50">
        </div>

        <div class="form-group">
            <label for="copies_available">Copies Available</label>
            <input type="number" class="form-control" id="copies_available" name="copies_available" value="{{ $books->copies_available }}" min="0">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="available" {{ $books->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="unavailable" {{ $books->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Book</button>
    </form>
</div>
@endsection
