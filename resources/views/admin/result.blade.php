@extends('backend.layouts.app')

@section('content')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h1>Result</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="GET" action="{{ route('admin.result') }}" class="mb-4">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Search Criteria</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Class</label>
                                            <select class="form-control" name="class_id" required>
                                                <option value="">Select</option>
                                                @foreach($getClass as $class)
                                                    <option {{ Request::get('class_id') == $class->id ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->class_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Exam</label>
                                            <select class="form-control" name="exam_id" required>
                                                <option value="">Select</option>
                                                @foreach($getExam as $exam)
                                                    <option {{ Request::get('exam_id') == $exam->id ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->exam_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="{{ route('admin.result') }}" class="btn btn-secondary">Clear</a>
                                </div>
                            </div>
                        </form>

                        @if(!empty($students) && !empty($subjects))
                            <div id="resultContainer">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Results</h3>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Student Name</th>
                                                        @foreach($subjects as $subject)
                                                            <th>
                                                                {{ $subject->subject_name }}
                                                                <div>Full Mark: <span class="badge badge-info">{{ optional($subject->examSchedules->first())->full_mark ?? 'N/A' }}</span></div>
                                                                <div>Passing Mark: <span class="badge badge-info">{{ optional($subject->examSchedules->first())->passing_mark ?? 'N/A' }}</span></div>
                                                            </th>
                                                        @endforeach
                                                        <th>Total Marks</th>
                                                        <th>Full Marks</th>
                                                        <th>Grade</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($students as $student)
                                                        @php
                                                            $totalMarks = 0;
                                                            $totalFullMarks = 0;
                                                            $hasFailedSubject = false;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                                            @foreach($subjects as $subject)
                                                                @php
                                                                    $classWork = $marksData[$student->id][$subject->id]['class_work'] ?? 0;
                                                                    $homeWork = $marksData[$student->id][$subject->id]['home_work'] ?? 0;
                                                                    $examWork = $marksData[$student->id][$subject->id]['exam_work'] ?? 0;
                                                                    $testWork = $marksData[$student->id][$subject->id]['test_work'] ?? 0;
                                                                    $subjectFullMark = optional($subject->examSchedules->first())->full_mark ?? 0;
                                                                    $subjectPassingMark = optional($subject->examSchedules->first())->passing_mark ?? 0;
                                                                    $subjectTotalMarks = $classWork + $homeWork + $examWork + $testWork;
                                                                    $totalMarks += $subjectTotalMarks;
                                                                    $totalFullMarks += $subjectFullMark;

                                                                    if ($subjectTotalMarks < $subjectPassingMark) {
                                                                        $hasFailedSubject = true;
                                                                    }
                                                                @endphp
                                                                <td>
                                                                    <div>Class Work: {{ $classWork }}</div>
                                                                    <div>Home Work: {{ $homeWork }}</div>
                                                                    <div>Exam: {{ $examWork }}</div>
                                                                    <div>Test Work: {{ $testWork }}</div>
                                                                    <div><strong>Total Mark: {{ $subjectTotalMarks }}</strong></div>
                                                                </td>
                                                            @endforeach
                                                            <td><strong>{{ $totalMarks }}</strong></td>
                                                            <td><strong>{{ $totalFullMarks }}</strong></td>
                                                            <td>
                                                                @if ($hasFailedSubject)
                                                                    <span class="badge badge-danger">F</span> <!-- Fail if any subject is below passing mark -->
                                                                @else
                                                                    @if ($totalMarks == 0 || $totalFullMarks == 0)
                                                                        <span class="badge badge-secondary">N/A</span>
                                                                    @else
                                                                        @php
                                                                            $percentage = ($totalMarks / $totalFullMarks) * 100;
                                                                            $grade = \App\Models\MarkGrade::getGrade($percentage);
                                                                        @endphp
                                                                        <span class="badge badge-primary">{{ $grade ? $grade->grade_name : 'N/A' }}</span>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning">No results found for the selected class and exam.</div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
