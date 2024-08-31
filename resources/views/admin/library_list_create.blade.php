@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>Add New Book</h1>
    <form action="{{ route('libraries.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="book_title">Book Title</label>
            <input type="text" class="form-control" id="book_title" name="book_title" value="{{ old('book_title') }}" required>
        </div>
        
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}" required>
        </div>
        
        <div class="form-group">
            <label for="publisher">Publisher</label>
            <input type="text" class="form-control" id="publisher" name="publisher" value="{{ old('publisher') }}">
        </div>
        
        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn') }}" maxlength="20">
        </div>
        
        <div class="form-group">
            <label for="published_year">Published Year</label>
            <input type="number" class="form-control" id="published_year" name="published_year" value="{{ old('published_year') }}" min="1000" max="{{ date('Y') }}">
        </div>
        
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}">
        </div>
        
        <div class="form-group">
            <label for="language">Language</label>
            <input type="text" class="form-control" id="language" name="language" value="{{ old('language') }}" maxlength="50">
        </div>
        
        <div class="form-group">
            <label for="copies_available">Copies Available</label>
            <input type="number" class="form-control" id="copies_available" name="copies_available" value="{{ old('copies_available', 0) }}" min="0">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Add Book</button>
    </form>
</div>
@endsection
