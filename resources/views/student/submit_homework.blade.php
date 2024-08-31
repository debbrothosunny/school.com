@extends('backend.layouts.app')

@section('content')
<div class="container">

    <h1 class="text-center">Submit Homework</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('student.homework.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="homework_id" value="{{ $homework->id }}">
                <div class="form-group">
                    <label for="document">Document:</label>
                    <input type="file" name="document" id="document" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit Homework</button>
            </form>
        </div>
    </div>
</div>

@endsection
