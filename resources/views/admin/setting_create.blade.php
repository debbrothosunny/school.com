<!-- resources/views/admin/setting_create.blade.php -->
@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>Add School Name</h1>
    <form action="{{ route('admin.setting.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="school_name">School Name</label>
            <input type="text" name="school_name" id="school_name" class="form-control" value="{{ old('school_name') }}" required>
        </div>
        <div class="form-group">
            <label for="copyright">Copyright</label>
            <input type="text" name="copyright" id="copyright" class="form-control" value="{{ old('copyright') }}">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
