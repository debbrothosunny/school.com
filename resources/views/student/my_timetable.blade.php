@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>My Timetable</h1>

    @if($timetables->isEmpty())
        <p>No timetables found for your class.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Week Name</th>
                    <th>Class Name</th>
                    <th>Subject Name</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Room Number</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach($timetables as $data)
                    <tr>
                        <td>{{ $data->week->week_name }}</td>
                        <td>{{ $data->className->class_name }}</td>
                        <td>{{ $data->subject->subject_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->start_time)->format('h:i A') }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->end_time)->format('h:i A') }}</td>
                        <td>{{ $data->room_number }}</td>
                        <!-- Add more columns as needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
