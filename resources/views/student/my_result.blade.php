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
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif(!isset($exam))
                            <div class="alert alert-warning">
                                No exam information available.
                            </div>
                        @elseif(!isset($subjects) || $subjects->isEmpty())
                            <div class="alert alert-warning mt-3" id="noResultsMessage">
                                No subjects found for the selected class and exam.
                            </div>
                        @endif

                        <div class="card">
                            @if(isset($exam))
                            <div class="card-header">
                                <h3 class="card-title">
                                    Exam: {{ $exam->exam_name }}
                                    <br>
                                    Student ID: {{ $student->id }}
                                </h3>
                                <!-- Print Button -->
                                <a href="{{ route('print.results', ['examId' => $exam->id, 'studentId' => $student->id]) }}" class="float-right">Print Results</a>
                            </div>
                            @endif
                            <div class="card-body p-0">
                                @if(isset($subjects) && $subjects->isNotEmpty())
                                    <div id="resultContainer">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Student Name</th>
                                                        @foreach($subjects as $subject)
                                                            <th>
                                                                {{ $subject->subject_name }}
                                                                <div>Type: <span class="badge badge-info">{{ $subject->type }}</span></div>
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
                                                    <tr>
                                                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                                        @php
                                                            $totalMarks = 0;
                                                            $totalFullMarks = 0;
                                                            $hasFailed = false;
                                                        @endphp
                                                        @foreach($subjects as $subject)
                                                            @php
                                                                $classWork = 0;
                                                                $homeWork = 0;
                                                                $examWork = 0;
                                                                $testWork = 0;
                                                                $subjectFullMark = optional($subject->examSchedules->first())->full_mark ?? 0;
                                                                $subjectPassingMark = optional($subject->examSchedules->first())->passing_mark ?? 0;

                                                                if (isset($marksData[$subject->id])) {
                                                                    $marks = $marksData[$subject->id]->first();
                                                                    if ($marks) {
                                                                        $classWork = $marks->class_work ?? 0;
                                                                        $homeWork = $marks->home_work ?? 0;
                                                                        $examWork = $marks->exam_work ?? 0;
                                                                        $testWork = $marks->test_work ?? 0;
                                                                    }
                                                                }

                                                                $subjectTotalMarks = $classWork + $homeWork + $examWork + $testWork;

                                                                $totalMarks += $subjectTotalMarks;
                                                                $totalFullMarks += $subjectFullMark;

                                                                if ($subjectTotalMarks < $subjectPassingMark) {
                                                                    $hasFailed = true;
                                                                }
                                                            @endphp
                                                            <td>
                                                                <div>Class Work: {{ $classWork }}</div>
                                                                <div>Home Work: {{ $homeWork }}</div>
                                                                <div>Exam: {{ $examWork }}</div>
                                                                <div>Test Work: {{ $testWork }}</div>
                                                                <div><strong>Total Mark: {{ $subjectTotalMarks }}</strong></div>
                                                                <div><strong>Passing Mark: {{ $subjectPassingMark }}</strong></div>
                                                                <div>
                                                                    Result: 
                                                                    @if($subjectTotalMarks >= $subjectPassingMark)
                                                                        <span class="badge badge-success">Pass</span>
                                                                    @else
                                                                        <span class="badge badge-danger">Fail</span>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        @endforeach
                                                        <td><strong>{{ $totalMarks }}</strong></td>
                                                        <td><strong>{{ $totalFullMarks }}</strong></td>
                                                        <td>
                                                            @php
                                                                $percent = $totalFullMarks > 0 ? ($totalMarks / $totalFullMarks) * 100 : 0;
                                                                $grade = App\Models\MarkGrade::getGrade($percent);
                                                            @endphp
                                                            <strong>
                                                                @if ($hasFailed)
                                                                    Fail
                                                                @else
                                                                    {{ $grade ? $grade->grade_name : 'N/A' }}
                                                                @endif
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@section('scripts')
<script>
    function printResults() {
        var printContents = document.getElementById('resultContainer').innerHTML;
        var originalContents = document.body.innerHTML;
        
        // Create a new window
        var printWindow = window.open('', '', 'height=800,width=1200');
        
        // Write content to the new window
        printWindow.document.write('<html><head><title>Print Result</title>' +
            '<link rel="stylesheet" href="{{ url('public/plugins/fontawesome-free/css/all.min.css') }}">' +
            '<link rel="stylesheet" href="{{ url('public/plugins/bootstrap/css/bootstrap.min.css') }}"></head><body>' +

            printContents + '</body></html>');
        
        // Close the document and print
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
    }
</script>
@endsection
@endsection
