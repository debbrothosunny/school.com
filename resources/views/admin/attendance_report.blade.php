@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>Attendance Report</h1>

    <form method="GET" action="{{ route('admin.attendance_report') }}">
        <div class="form-group">
            <label for="class_id">Select Class:</label>
            <select name="class_id" id="class_id" class="form-control" required>
                <option value="">Select</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ isset($class_id) && $class_id == $class->id ? 'selected' : '' }}>{{ $class->class_name }}</option>
                @endforeach
            </select>
        </div>
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

    @isset($students)
    <div id="attendance-report">
        <h2>Attendance Report for Class: {{ $classes->firstWhere('id', $class_id)->class_name ?? 'N/A' }}</h2>
        @if(empty($students))
            <p>No students found for this class.</p>
        @else
            @php
                $hasAttendance = false;
            @endphp
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Roll Number</th>
                        <th>Student Name</th>
                        @for($date = strtotime($start_date); $date <= strtotime($end_date); $date = strtotime("+1 day", $date))
                            <th>{{ date('Y-m-d', $date) }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->roll_number ?? 'N/A' }}</td>
                            <td>{{ $student->first_name ?? 'N/A' }} {{ $student->last_name ?? 'N/A' }}</td>
                            @for($date = strtotime($start_date); $date <= strtotime($end_date); $date = strtotime("+1 day", $date))
                                <td>
                                    @php
                                        $attendance_date = date('Y-m-d', $date);
                                        $attendance = $attendances[$student->id]->firstWhere('attendance_date', $attendance_date) ?? null;
                                        
                                        $attendance_type_str = 'N/A';
                                        if ($attendance && $attendance->attendance_type !== null) {
                                            $hasAttendance = true;
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
                                        }
                                    @endphp
                                    {{ $attendance_type_str }}
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if(!$hasAttendance)
                <p>No Attendance Report found.</p>
            @endif
        @endif
    </div>
    @endisset
</div>
@endsection
