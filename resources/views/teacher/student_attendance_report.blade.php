@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>Attendance Report</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="get" action="{{ route('teacher.student_attendance_report') }}">
        @csrf
        <div class="form-group">
            <label for="class_id">Select Class:</label>
            <select name="class_id" id="class_id" class="form-control" required>
                <option value="">Select</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ isset($class_id) && $class_id == $class->id ? 'selected' : '' }}>
                        {{ $class->class_name }}
                    </option>
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

    @if(isset($students) && count($students) > 0)
        <h2>Attendance Report for Class: {{ $class_name }}</h2>
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
                        <td>{{ $student->roll_number }}</td>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                        @for($date = strtotime($start_date); $date <= strtotime($end_date); $date = strtotime("+1 day", $date))
                            <td>
                                @php
                                    $attendance_date = date('Y-m-d', $date);
                                    $attendance = $attendances[$student->id]->where('attendance_date', $attendance_date)->first();
                                    $attendance_type = $attendance->attendance_type ?? null;

                                    // Map attendance type to string
                                    $attendance_type_str = match ($attendance_type) {
                                        1 => 'Present',
                                        2 => 'Absent',
                                        3 => 'Late',
                                        4 => 'Half Day',
                                        default => 'N/A',
                                    };
                                @endphp
                                {{ $attendance_type_str }}
                            </td>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(isset($students) && count($students) == 0)
        <p>No students found for the selected class and date range.</p>
    @endif
</div>
@endsection
