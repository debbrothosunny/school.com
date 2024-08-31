@extends('backend.layouts.app')

@section('content')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Students</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Classes and Students</h3>
                            </div>
                            <div class="card-body p-0">
                                @if($teacherClasses->isEmpty())
                                <div class="alert alert-warning mt-3">
                                    No students found.
                                </div>
                                @else
                                    @foreach($teacherClasses as $class)
                                        <h4>{{ $class->class_name ?? 'N/A' }}</h4>
                                        @if($class && $class->students && $class->students->isNotEmpty())
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Admission Number</th>
                                                        <th>Roll Number</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Gender</th>
                                                        <th>Date of Birth</th>
                                                        <th>Caste</th>
                                                        <th>Religion</th>
                                                        <th>Mobile Number</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($class->students as $data)
                                                        <tr>
                                                            <td>{{ $data->admission_number }}</td>
                                                            <td>{{ $data->roll_number }}</td>
                                                            <td>{{ $data->first_name }}</td>
                                                            <td>{{ $data->last_name }}</td>
                                                            <td>{{ ucfirst($data->gender) }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($data->d_o_b)->format('d-m-Y') }}</td>
                                                            <td>{{ $data->caste }}</td>
                                                            <td>{{ $data->religion }}</td>
                                                            <td>{{ $data->mobile_number }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <div class="alert alert-warning">
                                                No students found for this class.
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
