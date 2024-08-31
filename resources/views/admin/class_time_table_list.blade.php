@extends('backend.layouts.app')

@section('content')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $header_title }}</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                        <form action="{{ route('admin.save_timetable') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="class_name">Class Name</label>
                                <select class="form-control getClass" name="class_name" id="class_name">
                                    <option value="">Select Class</option>
                                    @foreach($classNames as $class_id => $className)
                                        <option value="{{ $class_id }}">{{ $className }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="subject_name">Subject Name</label>
                                <select class="form-control getSubject" name="subject_name" id="subject_name">
                                    <option value="">Select Subject</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="week_id">Week</label>
                                <select class="form-control" name="week_id" id="week_id">
                                    <option value="">Select Week</option>
                                    @foreach($weeks as $week_id => $week_name)
                                        <option value="{{ $week_id }}">{{ $week_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="teacher_id">Teacher</label>
                                <select class="form-control" name="teacher_id" id="teacher_id">
                                    <option value="">Select Teacher</option>
                                    @foreach($teachers as $teacher_id => $teacher_name)
                                        <option value="{{ $teacher_id }}">{{ $teacher_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="start_time">Start Time</label>
                                <input type="time" class="form-control" name="start_time" id="start_time">
                            </div>

                            <div class="form-group">
                                <label for="end_time">End Time</label>
                                <input type="time" class="form-control" name="end_time" id="end_time">
                            </div>

                            <div class="form-group">
                                <label for="room_number">Room Number</label>
                                <input type="text" class="form-control" name="room_number" id="room_number">
                            </div>

                            <div style="text-align: center; padding: 20px;">
                                <button type="submit" class="btn btn-primary">Submit Timetable</button>
                            </div>
                        </form>

                        <div id="timetableContainer">
                            @if($timeTables->isNotEmpty())
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Class Timetable</h3>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Week</th>
                                                    <th>Class Name</th>
                                                    <th>Subject Name</th>
                                                    <th>Teacher Name</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Room Number</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="timetableBody">
                                                @foreach($timeTables as $data)
                                                    <tr>
                                                        <td>{{ $data->week->week_name }}</td>
                                                        <td>{{ $data->className->class_name ?? 'N/A' }}</td>
                                                        <td>{{ $data->subject->subject_name }}</td>
                                                        <td>{{ $data->teacher->name ?? 'N/A' }}</td>
                                                        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $data->start_time)->format('h:i A') }}</td>
                                                        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $data->end_time)->format('h:i A') }}</td>
                                                        <td>{{ $data->room_number }}</td>
                                                        <td>
                                                            <form id="delete-form-{{ $data->id }}" action="{{ route('admin.delete_timetable', $data->id) }}" method="get" style="display: inline;">
                                                            <button type="button" class="btn btn-danger btn-delete" data-id="{{ $data->id }}">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning mt-3" id="noTimetableMessage">
                                    No timetables found.
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.getClass').change(function() {
            var classId = $(this).val();

            $.ajax({
                url: "{{ route('admin.get.subject') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    class_id: classId
                },
                dataType: "json",
                success: function(response) {
                    $('#subject_name').empty();
                    $('#subject_name').append('<option value="">Select Subject</option>');

                    if (response.html) {
                        $('#subject_name').append(response.html);
                    } else {
                        $('#subject_name').append('<option value="">No subjects found</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred while fetching subjects.');
                }
            });
        });
    });
</script>
@endsection
