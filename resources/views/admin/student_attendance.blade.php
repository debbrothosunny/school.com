@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>Attendance Register</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form to load attendance data -->
    <form method="GET" action="{{ route('attendance.show') }}">
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
            <label for="attendance_date">Attendance Date:</label>
            <input type="date" name="attendance_date" id="attendance_date" class="form-control" required value="{{ $attendance_date ?? '' }}">
        </div>
        <button type="submit" class="btn btn-primary">Load Attendance</button>
    </form>

    @isset($students)
    <!-- Form to save attendance data -->
    <form method="POST" action="{{ route('attendance.save') }}">
        @csrf
        <input type="hidden" name="class_id" value="{{ $class_id }}">
        <input type="hidden" name="attendance_date" value="{{ $attendance_date }}">
        <div id="student-attendance-form">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Roll Number</th>
                        <th>Student Name</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->roll_number }}</td>
                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="attendance[{{ $student->id }}]" value="present" {{ isset($attendances[$student->id]) && $attendances[$student->id]->attendance_type == 1 ? 'checked' : '' }}> Present
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="attendance[{{ $student->id }}]" value="absent" {{ isset($attendances[$student->id]) && $attendances[$student->id]->attendance_type == 2 ? 'checked' : '' }}> Absent
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="attendance[{{ $student->id }}]" value="late" {{ isset($attendances[$student->id]) && $attendances[$student->id]->attendance_type == 3 ? 'checked' : '' }}> Late
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="attendance[{{ $student->id }}]" value="half_day" {{ isset($attendances[$student->id]) && $attendances[$student->id]->attendance_type == 4 ? 'checked' : '' }}> Half Day
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Save Attendance</button>
        </div>
    </form>
    @endisset
</div>
@endsection
