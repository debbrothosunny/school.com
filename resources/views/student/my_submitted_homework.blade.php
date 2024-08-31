@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>My Submitted Homework</h1>

    <!-- Display Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display Error Message -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($submittedHomework->isEmpty())
        <p>No homework assigned yet.</p>
    @else

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Class Name</th>
                <th>Subject</th>
                <th>Homework Date</th>
                <th>Submission Date</th>
                <th>Description</th>
                <th>Document</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($submittedHomework as $submission)
                <tr>
                    <td>{{ $submission->id }}</td>
                    <td>{{ $submission->homework->className->class_name }}</td>
                    <td>{{ $submission->homework->subject->subject_name }}</td>
                    <td>{{ $submission->homework->homework_date }}</td>
                    <td>{{ $submission->homework->submission_date }}</td>
                    <td>{{ $submission->description }}</td>
                    <td><a href="{{ route('homework.download', $submission->homework->id) }}" class="btn btn-primary">Download Homework</a></td>
                    <td><a href="{{ route('homework.download', $submission->id) }}" class="btn btn-primary">Download Submission</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
