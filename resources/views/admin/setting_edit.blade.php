<!-- resources/views/admin/setting_edit.blade.php -->
@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>Edit School Name</h1>
    <form action="{{ route('admin.setting.update', $setting->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="school_name">School Name</label>
            <input type="text" name="school_name" class="form-control" value="{{ $setting->school_name }}" required>
        </div>
        <div class="form-group">
            <label for="copyright">Copyright</label>
            <input type="text" name="copyright" id="copyright" class="form-control" value="{{ old('copyright', $setting->copyright) }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
