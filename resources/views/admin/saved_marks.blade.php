<!-- resources/views/admin/saved_marks.blade.php

@extends('backend.layouts.app')

@section('content')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Saved Marks</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @if ($savedMarks->isEmpty())
                            <div class="alert alert-warning">
                                No saved marks found.
                            </div>
                        @else
                            <form method="GET" action="{{ route('admin.saved_marks') }}">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Search Marks</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label>Student Name</label>
                                                <input type="text" class="form-control" name="student_name" value="{{ request()->student_name }}">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Exam Name</label>
                                                <input type="text" class="form-control" name="exam_name" value="{{ request()->exam_name }}">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Class Name</label>
                                                <input type="text" class="form-control" name="class_name" value="{{ request()->class_name }}">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Subject Name</label>
                                                <input type="text" class="form-control" name="subject_name" value="{{ request()->subject_name }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                            <a href="{{ route('admin.saved_marks') }}" class="btn btn-primary">Clear</a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="card">
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Student Name</th>
                                                <th>Exam</th>
                                                <th>Class</th>
                                                <th>Subject</th>
                                                <th>Class Work</th>
                                                <th>Home Work</th>
                                                <th>Exam Work</th>
                                                <th>Test Work</th>
                                                <th>Date Saved</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($savedMarks as $mark)
                                                <tr>
                                                    <td>{{ $mark->id }}</td>
                                                    <td>{{ $mark->student->first_name }} {{ $mark->student->last_name }}</td>
                                                    <td>{{ $mark->exam->exam_name ?? 'N/A' }}</td>
                                                    <td>{{ $mark->className->class_name ?? 'N/A' }}</td>
                                                    <td>{{ $mark->subject->subject_name ?? 'N/A' }}</td>
                                                    <td>{{ $mark->class_work }}</td>
                                                    <td>{{ $mark->home_work }}</td>
                                                    <td>{{ $mark->exam_work }}</td>
                                                    <td>{{ $mark->test_work }}</td>
                                                    <td>{{ $mark->created_at->format('Y-m-d H:i:s') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $savedMarks->appends(request()->query())->links() }} <!-- Pagination links with query parameters -->
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection -->
