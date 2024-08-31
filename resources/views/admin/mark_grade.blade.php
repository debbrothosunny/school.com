@extends('backend.layouts.app')

@section('content')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mark Grades</h1>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Mark Grades List</h3>
                        <a href="{{ route('admin.mark_grade_add') }}" class="btn btn-primary float-right">Add Mark Grade</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Grade Name</th>
                                    <th>Percent From</th>
                                    <th>Percent To</th>
                                    <th>Created By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($markGrades as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->grade_name }}</td>
                                        <td>{{ $data->percent_from }}</td>
                                        <td>{{ $data->percent_to }}</td>
                                        <td>{{ $data->creator->name ?? 'Unknown' }}</td>
                                        <td>
                                            <a href="{{ route('admin.mark_grade_edit', $data->id) }}" class="btn btn-warning">Edit</a>


                                            <form id="delete-form-{{ $data->id }}" action="{{ route('admin.mark_grade_delete', $data->id) }}" method="get" style="display: inline;">
                                            <button type="button" class="btn btn-danger btn-delete" data-id="{{ $data->id }}">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
