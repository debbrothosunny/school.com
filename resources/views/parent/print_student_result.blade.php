<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Results</title>
    <link rel="stylesheet" href="{{ url('public/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/plugins/bootstrap/css/bootstrap.min.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-height: 80px;
        }
        .header h3 {
            margin: 10px 0;
            font-size: 24px;
        }
        .header h4 {
            margin: 5px 0;
            font-size: 18px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .badge-success {
            color: green;
        }
        .badge-danger {
            color: red;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .header, .table, .footer {
                page-break-inside: avoid;
            }
            .footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                text-align: center;
            }
            .table {
                font-size: 12px;
            }
            .header, .table {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ url('public/images/school_logo.png') }}" alt="School Logo">
        <h3>{{ $schoolName }}</h3> 
        <h4>Exam: {{ $examName }}</h4>
        <h4>Student Name: {{ $student->first_name }} {{ $student->last_name }}</h4>
        <h4>Admission Number: {{ $student->admission_number }}</h4>
        <h4>Roll Number: {{ $student->roll_number }}</h4>
        <h4>Class Name: {{ $student->className->class_name }}</h4>

    </div>

    @if($subjects->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Class Work</th>
                    <th>Test Work</th>
                    <th>Home Work</th>
                    <th>Exam</th>
                    <th>Total Score</th>
                    <th>Passing Marks</th>
                    <th>Full Marks</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
                @php
                    $classWork = $marksData[$subject->id]['class_work'] ?? 0;
                    $homeWork = $marksData[$subject->id]['home_work'] ?? 0;
                    $examWork = $marksData[$subject->id]['exam_work'] ?? 0;
                    $testWork = $marksData[$subject->id]['test_work'] ?? 0;

                    $subjectTotalMarks = $classWork + $homeWork + $examWork + $testWork;
                    $subjectFullMark = optional($subject->examSchedules->first())->full_mark ?? 0;
                    $subjectPassingMark = optional($subject->examSchedules->first())->passing_mark ?? 0;
                @endphp
                <tr>
                    <td>{{ $subject->subject_name }}</td>
                    <td>{{ $classWork }}</td>
                    <td>{{ $testWork }}</td>
                    <td>{{ $homeWork }}</td>
                    <td>{{ $examWork }}</td>
                    <td>{{ $subjectTotalMarks }}</td>
                    <td>{{ $subjectPassingMark }}</td>
                    <td>{{ $subjectFullMark }}</td>
                    <td>
                        @if($subjectTotalMarks >= $subjectPassingMark)
                            <span class="badge badge-success">Pass</span>
                        @else
                            <span class="badge badge-danger">Fail</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning" id="noResultsMessage">
            No subjects found for the selected class and exam.
        </div>
    @endif

    <div class="footer">
        <p>Generated on {{ now()->format('d-m-Y H:i:s') }}</p>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>
