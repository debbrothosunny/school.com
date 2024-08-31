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
            <h1>Parent List</h1>
          </div>
          <div class="col-sm-6" style="text-align:right;">
            <a class="btn btn-primary" href="{{ route('admin.parent_list_add') }}">Add New Parent</a>
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
                <h3 class="card-title">Search Parent</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('/admin/parent_list/search') }}" method="get">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label>Search</label>
                      <input type="text" class="form-control" value="{{ Request::get('search') }}" name="search" placeholder="Search by Name, Address, Mobile-Number">
                    </div>
                    <div class="form-group col-md-3">
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                      <a href="{{ url('admin/parent_list') }}" class="btn btn-primary" style="margin-top: 30px;">Clear</a>
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
            <!-- Parent List Table -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Parent List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Email</th>
                      <th>Father Name</th>
                      <th>Address</th>
                      <th>Profile Picture</th>
                      <th>Gender</th>
                      <th>Mobile Number</th>
                      <th>Occupation</th>
                      <th>Created At</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($parents as $data)
                    <tr>
                      <td>{{ $data->id }}</td>
                      <td class="text-truncate" style="max-width: 150px;">{{ $data->user->email }}</td> 
                      <td>{{ $data->name }}</td>
                      <td>{{ $data->address }}</td>
                      <td>
                            @if(!empty($data->profile_pic) && file_exists(public_path('storage/profile/' . $data->profile_pic)))
                                <img src="{!! url('public/storage/profile/'. $data->profile_pic) !!}" alt="" style="width:50px;height:50px;">
                            @else
                                No picture available
                            @endif
                      </td>
                      <td>{{ ucfirst($data->gender) }}</td>
                      <td>{{ $data->mobile_number }}</td>
                      <td>{{ $data->occupation }}</td>
                      <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y h:i A') }}</td>
                      <td>{{ $data->status == 0 ? 'Active' : 'Inactive' }}</td>
                      <td>
                        <div class="btn-group" role="group">
                          <a href="{{ url('admin/parent_list_edit/edit/'.$data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                          <form id="delete-form-{{ $data->id }}" action="{{ route('admin.parent_list.delete', $data->id) }}" method="get" style="display: inline;">
                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $data->id }}">Delete</button>
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

            <!-- Pagination Links -->
            <div class="d-flex justify-content-left">
              {{ $parents->links() }}
            </div>  
          </div>
        </div>
      </div>
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
@endsection
