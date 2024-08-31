
@extends('backend.layouts.app')
@section('content')
<div class="wrapper">
  <!-- Navbar -->

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

  <style>
    .button-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
   }
  </style>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Teacher List</h1>
          </div>
          <div class="col-sm-6" style="text-align:right;">
            <a class="btn btn-primary" href="{{ url('admin/teacher_list/add') }}">Add New Teacher</a>
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
                <h3 class="card-title">Search Teacher</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form action="{{ url('/admin/teacher_list/search') }}" method="GET">
                @csrf
                <div class="card-body">
                    <div class="row justify-content-center">
                      <div class="form-group col-md-4">
                          <label>Search</label>
                          <input type="text" class="form-control" value="{{ Request::get('search') }}" name="search" placeholder="Search by Name, Qualification, Mobile-Number,Date OF Joining">
                      </div>
                      <div class="form-group col-md-3">
                          <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                          <a href="{{ url('admin/teacher_list') }}" class="btn btn-primary" style="margin-top: 30px;">Clear</a>
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
           
            <!-- /.card -->

           
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-12">

      
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Teacher List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Marital</th>
                    <th>Qualification</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>C.Address</th>
                    <th>P.Address</th>
                    <th>Religion</th>
                    <th>Mobile</th>
                    <th>J.Date</th>
                    <th>Picture</th>
                    <th>Experience</th>
                    <th>Note</th>
                    <th>Blood.G</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td class="text-truncate" style="max-width: 150px;">{{ $data->user->email }}</td> 
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->marital_status }}</td>
                        <td>{{ $data->qualification }}</td>
                        <td>{{ ucfirst($data->gender) }}</td>
                        <td>{{ $data->d_o_b }}</td>
                        <td>{{ $data->c_address }}</td>
                        <td>{{ $data->p_address }}</td>
                        <td>{{ $data->religion }}</td>
                        <td>{{ $data->mobile_number }}</td>
                        <td>{{ $data->d_o_j }}</td>
                        <td>
                            @if(!empty($data->profile_pic) && file_exists(public_path('storage/profile/' . $data->profile_pic)))
                                <img src="{{ url('public/storage/profile/' . $data->profile_pic) }}" alt="" style="width:50px;height:50px;">
                            @else
                                No picture available
                            @endif
                        </td>
                        <td>{{ $data->experience }}</td>  
                        <td>{{ $data->note }}</td>
                        <td>{{ $data->blood_group }}</td>
                        <td>{{ $data->status == 0 ? 'Active' : 'Inactive' }}</td>
                        <td style="min-width: 120px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ url('admin/teacher_list_edit/edit/'.$data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                
                                <form id="delete-form-{{ $data->id }}" action="{{ route('admin.teacher_list.delete', $data->id) }}" method="get" style="display: inline;">
                                    <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $data->id }}">Delete</button>
                                </form>
                            </div>
                            <!-- <a href="{{ url('chat?receiver_id'.base64_encode($data->id)) }}" class="btn btn-danger">Send Message</a>  -->
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
              {{ $teachers->links() }}
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
    @include('backend/layouts.footer')
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


 

