@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>My Student Results</h1>

    @forelse($studentsResults as $studentId => $result)
        <div class="card mb-4">
            <div class="card-header">
                <h2>{{ ($result['student']->first_name ?? 'Unknown') . ' ' . ($result['student']->last_name ?? 'Unknown') }}'s Results</h2>
                @if($examId)
                    <a href="{{ route('parent.print_student_result', ['studentId' => $studentId, 'examId' => $examId]) }}" class="btn btn-primary">
                        Print Student Results
                    </a>
                @else
                    <p class="text-danger">No exam available to print results.</p>
                @endif
            </div>
            <div class="card-body">
                @isset($result['error'])
                    <p>{{ $result['error'] }}</p>
                @else
                    <p>Exam: {{ $result['exam']->exam_name ?? 'Unknown' }}</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Student</th>
                                @foreach($subjects as $subject)
                                    <th>{{ $subject->subject_name }}</th>
                                @endforeach
                                <th>Total Marks</th>
                                <th>Total Full Marks</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $student = $result['student'];
                                $totalMarks = 0;
                                $totalFullMarks = 0;
                                $hasFailedSubject = false;
                            @endphp
                            <tr>
                                <td>{{ $student->first_name ?? 'N/A' }} {{ $student->last_name ?? 'N/A' }}</td>
                                @foreach($subjects as $subject)
                                    @php
                                        $marks = $result['marksData']->get($subject->id)?->first();
                                        $classWork = $marks->class_work ?? 0;
                                        $homeWork = $marks->home_work ?? 0;
                                        $examWork = $marks->exam_work ?? 0;
                                        $testWork = $marks->test_work ?? 0;
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
                                        <span class="badge badge-danger">F</span>
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
                        </tbody>
                    </table>
                @endisset
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            No students found for this parent.
        </div>
    @endforelse
</div>
@endsection
