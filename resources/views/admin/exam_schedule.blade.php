@extends('backend.layouts.app')

@section('content')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-primary font-weight-bold">Exam Schedules</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.save_exam_schedule') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="class_id">Class Name</label>
                                <select class="form-control getClass" name="class_id" id="class_id">
                                    <option value="">Select Class</option>
                                    @foreach($classNames as $class)
                                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="subject_id">Subject Name</label>
                                <select class="form-control" name="subject_id" id="subject_id">
                                    <option value="">Select Subject</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exam_id">Exam</label>
                                <select class="form-control" name="exam_id" id="exam_id">
                                    <option value="">Select Exam</option>
                                    @foreach($exams as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->exam_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exam_date">Exam Date</label>
                                <input type="date" class="form-control" name="exam_date" id="exam_date">
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

                            <div class="form-group">
                                <label for="full_mark">Full Mark</label>
                                <input type="number" class="form-control" name="full_mark" id="full_mark">
                            </div>

                            <div class="form-group">
                                <label for="passing_mark">Passing Mark</label>
                                <input type="number" class="form-control" name="passing_mark" id="passing_mark">
                            </div>

                            <div style="text-align: center; padding: 20px;">
                                <button type="submit" class="btn btn-primary">Submit Exam Schedule</button>
                            </div>
                        </form>

                        <div id="timetableContainer">
                            @if($schedules->isNotEmpty())
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Exam Schedules</h3>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Serial</th>
                                                    <th>Exam Name</th>
                                                    <th>Class Name</th>
                                                    <th>Subject Name</th>
                                                    <th>Exam Date</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Room Number</th>
                                                    <th>Full Mark</th>
                                                    <th>Passing Mark</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($schedules as $data)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->exam->exam_name ?? 'N/A' }}</td>
                                                        <td>{{ $data->className->class_name ?? 'N/A' }}</td>
                                                        <td>{{ $data->subject->subject_name ?? 'N/A' }}</td>
                                                        <td>{{ $data->exam_date ?? 'N/A' }}</td>
                                                        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $data->start_time)->format('h:i A') }}</td>
                                                        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $data->end_time)->format('h:i A') }}</td>
                                                        <td>{{ $data->room_number }}</td>
                                                        <td>{{ $data->full_mark }}</td>
                                                        <td>{{ $data->passing_mark }}</td>
                                                        <td>
                                                        <form id="delete-form-{{ $data->id }}" action="{{ route('admin.delete_exam_schedule', $data->id) }}" method="get" style="display: inline;">
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
                                <div class="alert alert-warning mt-3" id="noScheduleMessage">
                                    No exam schedules found.
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
                url: "{{ route('admin.fetch_subjects') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    class_id: classId
                },
                dataType: "json",
                success: function(response) {
                    $('#subject_id').empty();
                    $('#subject_id').append('<option value="">Select Subject</option>');
                    $.each(response, function(id, name) {
                        $('#subject_id').append('<option value="' + id + '">' + name + '</option>');
                    });
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
