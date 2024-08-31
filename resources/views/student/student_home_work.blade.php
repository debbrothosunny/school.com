@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>My Homework</h1>

    <!-- Display student's assigned class and subject -->
    <p>Class Name: {{ $student->className->class_name }}</p>

    <!-- Homework List -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Homework Date</th>
                <th>Submission Date</th>
                <th>Description</th>
                <th>Subject Name</th>
                <th>Document</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($homeworks as $homework)
                <tr>
                    <td>{{ $homework->id }}</td>
                    <td>{{ $homework->homework_date }}</td>
                    <td>{{ $homework->submission_date }}</td>
                    <td>{{ $homework->description }}</td>
                    <td>{{ $homework->subject->subject_name }}</td>
                    <td><a href="{{ route('homework.download', $homework->id) }}" class="btn btn-primary">Download</a></td>
                    <td>
                        <a href="{{ url('student/homework/submit/'.$homework->id) }}" class="btn btn-primary">Submit Homework</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
