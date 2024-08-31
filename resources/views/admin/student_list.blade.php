@extends('backend.layouts.app')
@section('content')
<div class="wrapper">

  <style>
    .table-responsive {
      overflow-x: auto;
    }

    .table thead th {
      position: sticky;
      top: 0;
      background-color: #343a40;
      color: #fff;
      z-index: 1;
    }

    .text-truncate {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .button-container {
      display: flex;
      gap: 5px;
      /* Adjust the gap as needed */
    }

    .button-container .btn {
      margin: 0;
      /* Remove default margin if any */
    }
  </style>
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
            <h1>Student List</h1>
          </div>
          <div class="col-sm-6" style="text-align:right;">
            <a class="btn btn-primary" href="{{ route('admin.student_list_add') }}">Add New Student List</a>
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

            <div class="card">
              <div class="card-header">
                <h3 class="card-title" Search Admin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form method="GET" action="{{ url('admin/student_list') }}">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label>First Name</label>
                      <input type="text" class="form-control" value="{{ Request::get('first_name') }}" name="first_name" placeholder="First Name">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Admission Number</label>
                      <input type="text" class="form-control" value="{{ Request::get('admission_number') }}" name="admission_number" placeholder="Admission Number">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Roll Number</label>
                      <input type="text" class="form-control" value="{{ Request::get('roll_number') }}" name="roll_number" placeholder="Roll Number">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Email</label>
                      <input type="text" class="form-control" name="email" value="{{ Request::get('email') }}" placeholder="Email">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Date</label>
                      <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}">
                    </div>
                    <div class="form-group col-md-3">
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                      <a href="{{ url('admin/student_list') }}" class="btn btn-primary" style="margin-top: 30px;">Clear</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
    
            <!-- /.card -->

            <div class="card p-0" style="overflow:auto;">
              <div class="card-header">
                <h3 class="card-title">Student List</h3>
              </div>
              <!-- /.card-header -->
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead class="thead-dark">
                    <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Adm. No.</th>
                    <th>Roll No.</th>
                    <th>Class</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Caste</th>
                    <th>Religion</th>
                    <th>Mobile</th>
                    <th>Adm. Date</th>
                    <th>Profile Pic</th>
                    <th>Blood Type</th>
                    <th>Height</th>
                    <th>Weight</th>
                    <th>Created</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($students as $data)
                    <tr>
                      <td>{{ $data->id }}</td>
                      <td class="text-truncate" style="max-width: 150px;">{{ $data->user->email }}</td>
                      <td>{{ $data->admission_number }}</td>
                      <td>{{ $data->roll_number }}</td>
                      <td>{{ $data->class->class_name ?? 'N/A' }}</td>
                      <td>{{ $data->first_name }}</td>
                      <td>{{ $data->last_name }}</td>
                      <td>{{ ucfirst($data->gender) }}</td>
                      <td>{{ \Carbon\Carbon::parse($data->d_o_b)->format('d-m-Y') }}</td>
                      <td>{{ $data->caste }}</td>
                      <td>{{ $data->religion }}</td>
                      <td>{{ $data->mobile_number }}</td>
                      <td>{{ \Carbon\Carbon::parse($data->admission_date)->format('d-m-Y') }}</td>
                      <td>
                            @if(!empty($data->profile_pic) && file_exists(public_path('storage/profile/' . $data->profile_pic)))
                                <img src="{!! url('public/storage/profile/'. $data->profile_pic) !!}" alt="" style="width:50px;height:50px;">
                            @else
                                No picture available
                            @endif
                      </td>
                      <td>{{ $data->blood_group }}</td>
                      <td>{{ $data->height }}</td>
                      <td>{{ $data->weight }}</td>
                      <td>{{ date('d-m-Y h:i A', strtotime($data->created_at)) }}</td>
                      <td>{{ $data->status == 0 ? 'Active' : 'Inactive' }}</td>
                      <td style="min-width: 80px;">
                        <div class="button-container">
                          <a href="{{ url('admin/student_list_edit/edit/'.$data->id) }}" class="btn btn-primary btn-sm">Edit</a>

                          <form id="delete-form-{{ $data->id }}" action="{{ route('admin.student_list.delete', $data->id) }}" method="get" style="display: inline;">
                              <button type="button" class="btn btn-danger btn-delete" data-id="{{ $data->id }}">Delete</button>
                          </form> 
                          <!-- <a href="{{ url('chat?receiver_id'.base64_encode($data->id)) }}" class="btn btn-danger">Send Message</a>  -->
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-left">
              {{ $students->links() }}
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

  <!-- /.control-sidebar -->
</div>
<!-- Content Header (Page header) -->
  
<!-- /.content -->
</div>

@endsection