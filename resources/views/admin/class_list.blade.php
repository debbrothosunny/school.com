@extends('backend.layouts.app')

@section('content')
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->

        <!-- Right navbar links -->

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Assign Class List</h1>
                    </div>
                    <div class="col-sm-6" style="text-align:right;">
                        <a class="btn btn-primary" href="{{ route('admin.class_list_add') }}">Add New Class List</a>
                    </div>
                </div>
            </div>
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
                                <h3 class="card-title">Search Class</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
  
                            <form action="{{ route('admin.class_list') }}" method="get">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Name</label>
                                            <input type="text" class="form-control" value="{{ old('class_name') }}"
                                                name="class_name" placeholder="Class Name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Date</label>
                                            <input type="date" class="form-control" name="date"
                                                value="{{ Request::get('date') }}" placeholder="Date">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" type="submit"
                                                style="margin-top: 30px;">Search</button>
                                            <a href="{{ url('admin/class_list') }}" class="btn btn-primary"
                                                style="margin-top: 30px;">Clear</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Class List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Class Name</th>
                                            <th>Amount</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($classes as $class)
                                        <tr>
                                            <td>{{ $class->id }}</td>
                                            <td>{{ $class->class_name ?? 'N/A' }}</td>
                                            <td>{{ number_format($class->amount, 2) }} ৳</td>
                                            <td>{{ date('d-m-Y h:i A', strtotime($class->created_at)) }}</td>
                                            <td>
                                                @if ($class->status == 0) 
                                                <span class="btn btn-sm btn-primary mb-0">Active</span>
                                                @else
                                                <span class="btn btn-sm btn-success mb-0">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/class_list_edit/edit/'.$class->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <form id="delete-form-{{ $class->id }}" action="{{ route('admin.class_list.delete', $class->id) }}" method="get" style="display: inline;">
                                                    <button type="button" class="btn btn-danger btn-delete" data-id="{{ $class->id }}">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7">No classes found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                         <!-- Pagination Links -->
                        <div class="d-flex justify-content-left">
                        {{ $classes->links() }}
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>


<!-- /.wrapper -->
@endsection
