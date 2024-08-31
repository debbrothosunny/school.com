@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>Submitted Homework</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Class Name</th>
                <th>Subject</th>
                <th>Homework Date</th>
                <th>Submission Date</th>
                <th>Comments</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($submittedHomework as $submission)
                <tr>
                    <td>{{ $submission->id }}</td>
                    <td>{{ $submission->student->first_name}}</td>
                    <td>{{ $submission->student->last_name}}</td>
                    <td>{{ $submission->homework->className->class_name }}</td>
                    <td>{{ $submission->homework->subject->subject_name }}</td>
                    <td>{{ $submission->homework->homework_date }}</td>
                    <td>{{ $submission->homework->submission_date }}</td>
                    <td>{{ $submission->description }}</td>
                    <td><a href="{{ route('homework.download', $submission->document) }}" class="btn btn-primary">Download Submission</a></td>
                    <td>
                        <form action="{{ route('homework.delete', $submission->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this submission?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
