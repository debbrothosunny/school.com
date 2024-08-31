@extends('backend.layouts.app')

@section('content')
<div class="wrapper">
    <style>
        .container {
            overflow-y: auto;
            height: 100vh;
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            /* background-color: #f5f5f5; */
            border-bottom: 1px solid #e0e0e0;
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .card-body {
            padding: 20px;
        }

        .table-responsive {
            overflow-y: auto;
            max-height: 400px; /* Adjust as needed */
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        .table th {
            /* background-color: #f9f9f9; */
            font-weight: 600;
        }

        .btn {
            border: 1px solid #ddd;
            padding: 8px 16px;
            font-size: 0.9rem;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn:hover {
            background-color: #e0e0e0;
            border-color: #ccc;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .form-section {
            padding: 20px;
            border-top: 1px solid #e0e0e0;
        }

        h2 {
            font-size: 1.75rem;
            margin-bottom: 15px;
            /* color: #333; */
        }

        label {
            font-weight: 500;
            margin-bottom: 10px;
            display: block;
        }

        .form-control {
            border: 1px solid #ddd;
            padding: 12px;
            border-radius: 4px;
            font-size: 1rem;
            width: 100%;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }

        .btn-block {
            width: 100%;
            text-align: center;
        }
            .form-control {
        border: 1px solid #ddd;
        padding: 12px;
        border-radius: 4px;
        font-size: 1rem;
        width: 100%;
        box-sizing: border-box;
        height: auto; /* Ensure height is not constrained */
        line-height: 1.5; /* Adjust line height for better readability */
        background-color: #fff; /* Ensure background color is set */
    }

    .form-control option {
        padding: 8px; /* Ensure padding inside options */
    }

    .select-wrapper {
        position: relative;
        width: 100%;
    }

    .select-wrapper::after {
        content: '▼'; /* Optional: Add a dropdown indicator */
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #aaa;
    }
    </style>

    <div class="content-wrapper">
        <!-- Manage Homework Card -->
        <div class="card">
            <div class="card-header">
                <h2>Manage Homework</h2>
            </div>
            <div class="card-body">
                <!-- Homework List -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Class Name</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>Homework Date</th>
                                <th>Submission Date</th>
                                <th>Description</th>
                                <th>Document</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($homeworks as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->className->class_name }}</td>
                                    <td>{{ $data->subject->subject_name }}</td>
                                    <td>{{ $data->teacher->name ?? 'N/A' }}</td>
                                    <td>{{ $data->homework_date }}</td>
                                    <td>{{ $data->submission_date }}</td>
                                    <td>{{ Str::limit($data->description, 30) }}</td>
                                    <td>
                                        <a href="{{ route('homework.download', $data->id) }}" class="btn btn-primary">Download</a>
                                    </td>
                                    <td>
                                        <form id="delete-form-{{ $data->id }}" action="{{ route('homework.delete', $data->id) }}" method="GET" style="display: inline;">
                                            <button type="button" class="btn btn-danger btn-delete" data-id="{{ $data->id }}">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Create Homework Form -->
        <div class="card form-section">
            <div class="card-header">
                <h2>Create New Homework</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('homework.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="class_id">Select Class:</label>
                        <div class="select-wrapper">
                            <select name="class_id" id="class_id" class="form-control" required>
                                <option value="">Select</option>
                                @foreach($classNames as $class)
                                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subject_id">Select Subject:</label>
                        <select name="subject_id" id="subject_id" class="form-control" required>
                            <option value="">Select</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="teacher_id">Select Teacher:</label>
                        <select name="teacher_id" id="teacher_id" class="form-control" required>
                            <option value="">Select</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="homework_date">Homework Date:</label>
                        <input type="date" name="homework_date" id="homework_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="submission_date">Submission Date:</label>
                        <input type="date" name="submission_date" id="submission_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="document">Document:</label>
                        <input type="file" name="document" id="document" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Homework</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('class_id').addEventListener('change', function() {
        var classId = this.value;
        if (classId) {
            fetch('{{ route('admin.fetchHomeworkSubjects') }}?class_id=' + classId)
                .then(response => response.json())
                .then(data => {
                    var subjectSelect = document.getElementById('subject_id');
                    subjectSelect.innerHTML = '<option value="">Select</option>';
                    for (const [key, value] of Object.entries(data)) {
                        subjectSelect.innerHTML += `<option value="${key}">${value}</option>`;
                    }
                });
        }
    });
</script>
@endsection
