@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>My Attendance</h1>

    <form method="get" action="{{ route('student.my_attendance') }}">
        @csrf
        <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required value="{{ $start_date ?? '' }}">
        </div>
        <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required value="{{ $end_date ?? '' }}">
        </div>
        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>

    @if(isset($attendances) && count($attendances) > 0)
        <h2>Attendance Report for {{ $student->first_name }} {{ $student->last_name }}</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Attendance Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $date => $attendance_records)
                    @php
                        $attendance = $attendance_records->first();
                        $attendance_type_str = 'N/A';
                        switch ($attendance->attendance_type) {
                            case 1:
                                $attendance_type_str = 'Present';
                                break;
                            case 2:
                                $attendance_type_str = 'Absent';
                                break;
                            case 3:
                                $attendance_type_str = 'Late';
                                break;
                            case 4:
                                $attendance_type_str = 'Half Day';
                                break;
                        }
                    @endphp
                    <tr>
                        <td>{{ $date }}</td>
                        <td>{{ $attendance_type_str }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(isset($attendances) && count($attendances) == 0)
        <p>No attendance records found for the selected date range.</p>
    @endif
</div>
@endsection
