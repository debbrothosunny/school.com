@extends('backend.layouts.app')
@section('content')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mark Register</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="GET" action="{{ route('admin.mark_register') }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Exam</label>
                                        <select class="form-control" name="exam_id" required>
                                            <option value="">Select</option>
                                            @foreach($getExam as $exam)
                                                <option {{ Request::get('exam_id') == $exam->id ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->exam_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Class</label>
                                        <select class="form-control getClass" name="class_id" required>
                                            <option value="">Select</option>
                                            @foreach($getClass as $class)
                                                <option {{ Request::get('class_id') == $class->id ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->class_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{ route('admin.mark_register') }}" class="btn btn-primary">Clear</a>
                            </div>
                        </form>

                        @if(!empty($students))
                            @if(!empty($subjects))
                                <div id="marksContainer">
                                    <div class="card mt-3">
                                        <div class="card-header">
                                            <h3 class="card-title">Marks</h3>
                                        </div>
                                        <div class="card-body p-0">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Student Name</th>
                                                    @foreach($subjects as $subject)
                                                        <th>
                                                            {{ $subject->subject_name }}
                                                            <div>Full Mark: <span class="full-mark" data-subject-id="{{ $subject->id }}">{{ $subject->examSchedules->first()->full_mark ?? 'N/A' }}</span></div>
                                                            <div>Passing Mark: <span class="passing-mark" data-subject-id="{{ $subject->id }}">{{ $subject->examSchedules->first()->passing_mark ?? 'N/A' }}</span></div>
                                                        </th>
                                                    @endforeach
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($students as $student)
                                                        <tr>
                                                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>

                                                            @foreach($subjects as $subject)
                                                                <td>
                                                                    <div class="form-group">
                                                                        Class Work
                                                                        <input type="number" class="form-control mark-input" data-student-id="{{ $student->id }}" data-subject-id="{{ $subject->id }}" placeholder="Enter Marks" name="marks[{{ $student->id }}][{{ $subject->id }}][class_work]" value="{{ isset($marksData[$student->id][$subject->id]) ? $marksData[$student->id][$subject->id]->class_work : '' }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        Home Work
                                                                        <input type="number" class="form-control mark-input" data-student-id="{{ $student->id }}" data-subject-id="{{ $subject->id }}" placeholder="Enter Marks" name="marks[{{ $student->id }}][{{ $subject->id }}][home_work]" value="{{ isset($marksData[$student->id][$subject->id]) ? $marksData[$student->id][$subject->id]->home_work : '' }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        Exam
                                                                        <input type="number" class="form-control mark-input" data-student-id="{{ $student->id }}" data-subject-id="{{ $subject->id }}" placeholder="Enter Marks" name="marks[{{ $student->id }}][{{ $subject->id }}][exam_work]" value="{{ isset($marksData[$student->id][$subject->id]) ? $marksData[$student->id][$subject->id]->exam_work : '' }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        Test Work
                                                                        <input type="number" class="form-control mark-input" data-student-id="{{ $student->id }}" data-subject-id="{{ $subject->id }}" placeholder="Enter Marks" name="marks[{{ $student->id }}][{{ $subject->id }}][test_work]" value="{{ isset($marksData[$student->id][$subject->id]) ? $marksData[$student->id][$subject->id]->test_work : '' }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="button" class="btn btn-primary SaveSingleSubject" data-student-id="{{ $student->id }}" data-subject-id="{{ $subject->id }}">Save</button>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        Total Marks: <span class="total-marks" data-student-id="{{ $student->id }}" data-subject-id="{{ $subject->id }}">0</span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        Status: <span class="status" data-student-id="{{ $student->id }}" data-subject-id="{{ $subject->id }}">N/A</span>
                                                                    </div>
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning mt-3" id="noMarksMessage">
                                    No exam schedules found for the selected exam and class.
                                </div>
                            @endif
                        @else
                            <div class="alert alert-warning mt-3" id="noMarksMessage">
                                No students found for the selected exam and class.
                            </div>
                        @endif
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
    // Handle individual subject save
    $('.SaveSingleSubject').click(function() {
        var studentId = $(this).data('student-id');
        var subjectId = $(this).data('subject-id');

        var classWork = parseFloat($('input[name="marks[' + studentId + '][' + subjectId + '][class_work]"]').val()) || 0;
        var homeWork = parseFloat($('input[name="marks[' + studentId + '][' + subjectId + '][home_work]"]').val()) || 0;
        var examWork = parseFloat($('input[name="marks[' + studentId + '][' + subjectId + '][exam_work]"]').val()) || 0;
        var testWork = parseFloat($('input[name="marks[' + studentId + '][' + subjectId + '][test_work]"]').val()) || 0;

        var totalMarks = classWork + homeWork + examWork + testWork;

        var fullMark = parseFloat($('.full-mark[data-subject-id="' + subjectId + '"]').text()) || 0;
        var passingMark = parseFloat($('.passing-mark[data-subject-id="' + subjectId + '"]').text()) || 0;

        if (totalMarks > fullMark) {
            alert('Total marks cannot exceed the full mark of ' + fullMark);
            return;
        }

        var formData = {
            student_id: studentId,
            exam_id: $('select[name="exam_id"]').val(),
            class_id: $('select[name="class_id"]').val(),
            subject_id: subjectId,
            marks: {
                class_work: classWork,
                home_work: homeWork,
                exam_work: examWork,
                test_work: testWork
            },
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: '{{ route('admin.saveSingleSubjectMarks') }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                alert('Marks saved successfully!');
                updateStatus(studentId, subjectId, totalMarks, passingMark);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                var errorMessage = 'An error occurred while saving individual marks.';
                alert(errorMessage);
            }
        });
    });

    function updateStatus(studentId, subjectId, totalMarks, passingMark) {
        var status = totalMarks >= passingMark ? 'Pass' : 'Fail';
        $('.total-marks[data-student-id="' + studentId + '"][data-subject-id="' + subjectId + '"]').text(totalMarks);
        $('.status[data-student-id="' + studentId + '"][data-subject-id="' + subjectId + '"]').text(status).addClass(status === 'Pass' ? 'badge badge-success' : 'badge badge-danger');
    }
});
</script>
@endsection
