@extends('backend.layouts.app')

@section('content')
<div class="container">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h1>My Class Subjects</h1>

    @if($assignments->isEmpty())
        <p>No subjects assigned.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Class Name</th>
                    <th>Subject Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignments as $data)
                    <tr>
                        <td>{{ $data->className->class_name ?? 'N/A'}}</td>
                        <td>{{ $data->subject->subject_name ?? 'N/A' }}</td>
                        <td>
                        <a href="{{ route('teacher.class_timetable', $data->id) }}" class="btn btn-primary">My Class Timetable</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
