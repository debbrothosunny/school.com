
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Exam List</h1>
          </div>
          <div class="col-sm-6" style="text-align:right;">
            <a class="btn btn-primary" href="{{ route('admin.exam_list_add') }}">Add New Exam List</a>
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
                <h3 class="card-title">Search Exam </h3>
              </div>
              <!-- /.card-header -->   
              <!-- form start -->

              <form action="" method="get">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">  
                        <label>Exam Name</label>
                        <input type="text" class="form-control" value="{{ old('exam_name') }}" name="exam_name"  placeholder="Exam Name">
                    </div>
                    <div class="form-group col-md-3">  
                        <label>Note</label>
                        <input type="text" class="form-control" value="{{ old('note') }}" name="note"  placeholder="Note">
                    </div>
                    <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                        <a href="{{ url('admin/exam_list') }}" class="btn btn-primary" style="margin-top: 30px;">Clear</a>
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
          <div class="col-md-6">
          </div>
          <!-- /.col -->
          <div class="col-md-12">
      

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Exam List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Exam Name</th>
                      <th>Note</th>
                      <th>Created By Name</th>
                      <th>Created At</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach ($exams as $data)
                    <tr>
                      <td>{{ $data->id }}</td>
                      <td>{{ $data->exam_name }}</td>
                      <td>{{ $data->note ?? 'N/A'}}</td>
                      <td>{{ $data->creator->name ?? 'Unknown' }}</td>
                      <td>{{ date('d-m-Y h:i A', strtotime($data->created_at)) }}</td>
                      <td>
                          @if ($data->status == 0)
                              <p class="btn btn-sm btn-primary mb-0">Active</p>
                          @else
                              <p class="btn btn-sm btn-success mb-0">Inactive</p>
                          @endif
                      <td>
                          <a href="{{ url('admin/exam_list_edit/edit/'.$data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                          
                          <form id="delete-form-{{ $data->id }}" action="{{ route('admin.exam_list.delete', $data->id) }}" method="get" style="display: inline;">
                          <button type="button" class="btn btn-danger btn-delete" data-id="{{ $data->id }}">Delete</button>
                          </form>

                      </td>
                      </td>
                    </tr>
                   @endforeach

                  </tbody>
                </table>

              </div>
              <!-- /.card-body -->
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-right">
              {{ $exams->links() }}
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
       
        <!-- /.row -->
   
        <!-- /.row -->
    
        <!-- /.row -->

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- /.control-sidebar -->
</div>
    <!-- Content Header (Page header) -->

    <!-- /.content -->
  </div>

  @endsection

