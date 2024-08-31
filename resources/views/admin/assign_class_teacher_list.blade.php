@extends('backend.layouts.app')
@section('content')
<div class="wrapper">
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Assign Class Teacher List</h1>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6" style="text-align:right;">
                        <a class="btn-btn primary" href="{{ route('assign_class_teacher.add') }}">Add New Assign Class Teacher</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Search Assign Class Teacher</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
    
                            <form action="{{ route('assign_class_teacher.search') }}" method="GET">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Class Name</label>
                                            <input type="text" class="form-control" value="{{ request()->get('class_name') }}" name="class_name" placeholder="Class Name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Teacher Name</label>
                                            <input type="text" class="form-control" value="{{ request()->get('teacher_name') }}" name="teacher_name" placeholder="Teacher Name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Created At</label>
                                            <input type="date" class="form-control" name="created_at" value="{{ request()->get('created_at') }}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                                            <a href="{{ route('admin.assign_class_teacher_list') }}" class="btn btn-primary" style="margin-top: 30px;">Clear</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-12">

                    <!-- Your form and input fields -->

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Assign Class Teacher</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Class Name</th>
                                            <th>Subject Name</th>
                                            <th>Teacher Name</th>
                                            <th>Created By Name</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($assignments as $data)
                                            <tr>
                                                <td>{{ $data->id }}</td>
                                                <td>{{ $data->className->class_name ?? 'N/A' }}</td>
                                                <td>{{ $data->subject->subject_name ?? 'N/A' }}</td>
                                                <td>{{ $data->teacher->name ?? 'N/A'}}</td>
                                                <td>{{ $data->creator->name ?? 'N/A'}}</td>
                                                <td>{{ $data->created_at }}</td>
                                                <td>{{ $data->status == 0 ? 'Active' : 'Inactive' }}</td>
                                                <td style="min-width: 80px;">
                                                    <div class="button-container">
                                                        <a href="{{ route('assign_class_teacher.edit', $data->id) }}" class="btn btn-primary">Edit</a>
                                                        
                                                        <form id="delete-form-{{ $data->id }}" action="{{ route('assign_class_teacher.delete', $data->id) }}" method="get" style="display: inline;">
                                                        <button type="button" class="btn btn-danger btn-delete" data-id="{{ $data->id }}">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside
