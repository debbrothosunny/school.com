@extends('backend.layouts.app')

@section('content')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Assigned HomeWork</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div id="homeworkContainer">
                            @if($homeworks->isNotEmpty())
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Homeworks</h3>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Class Name</th>
                                                    <th>Subject Name</th>
                                                    <th>Homework Date</th>
                                                    <th>Submission Date</th>
                                                    <th>Description</th>
                                                    <th>Document</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($homeworks as $data)
                                                    <tr>
                                                        <td>{{ $data->className->class_name }}</td>
                                                        <td>{{ $data->subject->subject_name }}</td>
                                                        <td>{{ $data->homework_date }}</td>
                                                        <td>{{ $data->submission_date }}</td>
                                                        <td>{{ $data->description }}</td>
                                                        <td>
                                                            <a href="{{ route('homework.download', $data->id) }}" class="btn btn-primary">Download</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning mt-3" id="noHomeworkMessage">
                                    No homeworks found.
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
