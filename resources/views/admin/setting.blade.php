@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>School Settings</h1>
    <a href="{{ route('admin.setting.create') }}" class="btn btn-primary">Add School Name</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>School Name</th>
                <th>Copyright</th> 
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($settings as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->school_name }}</td>
                <td>{{ $data->copyright}}</td>
                <td>
                    <a href="{{ route('admin.setting.edit', $data->id) }}" class="btn btn-primary">Edit</a>
                    <form id="delete-form-{{ $data->id }}" action="{{ route('admin.setting.destroy', $data->id) }}" method="post" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-delete" data-id="{{ $data->id }}">Delete</button>
                    </form> 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
