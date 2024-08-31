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
            <h1>Admin List</h1>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-6" style="text-align:right;">
            <a class="btn-btn primary" href="{{ url('admin/parent_list/add') }}">Add New Parent Student</a>
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

          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">

            <!-- /.card -->


            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-12">
 

            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Student List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="container">
                  <h1>Student Information</h1>
                  @if($student)
            <table class="table table-bordered">
            <tr>
              <th>Admission Number</th>
              <td>{{ $student->admission_number }}</td>
            </tr>
            <tr>
              <th>Roll Number</th>
              <td>{{ $student->roll_number }}</td>
            </tr>
            <tr>
              <th>Class</th>
              <td>{{ $student->class->class_name }}</td>
            </tr>
            <tr>
              <th>First Name</th>
              <td>{{ $student->first_name }}</td>
            </tr>
            <tr>
              <th>Last Name</th>
              <td>{{ $student->last_name }}</td>
            </tr>
            <tr>
              <th>Gender</th>
              <td>{{ ucfirst($student->gender) }}</td>
            </tr>
            <tr>
              <th>Date of Birth</th>
              <td>{{ $student->d_o_b }}</td>
            </tr>
            <tr>
              <th>Caste</th>
              <td>{{ $student->caste }}</td>
            </tr>
            <tr>
              <th>Religion</th>
              <td>{{ $student->religion }}</td>
            </tr>
            <tr>
              <th>Mobile Number</th>
              <td>{{ $student->mobile_number }}</td>
            </tr>
            <tr>
              <th>Admission Date</th>
              <td>{{ $student->admission_date }}</td>
            </tr>
            <tr>
              <th>Blood Group</th>
              <td>{{ $student->blood_group }}</td>
            </tr>
            <tr>
              <th>Height</th>
              <td>{{ $student->height }}</td>
            </tr>
            <tr>
              <th>Weight</th>
              <td>{{ $student->weight }}</td>
            </tr>
            <tr>
              <th>Status</th>
              <td>
                @if ($student->status == 0)
                    <p class="btn btn-sm btn-primary mb-0">Active</p>
                @else
                    <p class="btn btn-sm btn-success mb-0">Inactive</p>
                @endif
              <td>
            </tr>
            </table>
          @else    
        <p>No student information available for this parent.</p>
      @endif
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
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
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- Content Header (Page header) -->

<!-- /.content -->
</div>

@endsection