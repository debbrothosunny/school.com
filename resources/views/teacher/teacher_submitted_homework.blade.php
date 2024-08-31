@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>Submitted Homework</h1>

    @if($submittedHomework->isEmpty())
        <p>No homework assigned yet.</p>
    @else
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
                    <th>Description</th>
                    <th>Document</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
