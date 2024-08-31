@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="text-center" style="color: #007BFF;">My Exam Schedule</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($schedules->isNotEmpty())
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Exam Schedules</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Exam Name</th>
                                    <th>Class Name</th>
                                    <th>Subject Name</th>
                                    <th>Exam Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Room Number</th>
                                    <th>Full Mark</th>
                                    <th>Passing Mark</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td>{{ $schedule->exam->exam_name }}</td>
                                        <td>{{ $schedule->className->class_name }}</td>
                                        <td>{{ $schedule->subject->subject_name }}</td>
                                        <td>{{ $schedule->exam_date }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('h:i A') }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('h:i A') }}</td>
                                        <td>{{ $schedule->room_number }}</td>
                                        <td>{{ $schedule->full_mark }}</td>
                                        <td>{{ $schedule->passing_mark }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="alert alert-warning mt-3" id="noScheduleMessage">
                    No exam schedules found.
                </div>
                @if(session('debug'))
                    <div class="alert alert-info">
                        Debug info: {{ session('debug') }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
