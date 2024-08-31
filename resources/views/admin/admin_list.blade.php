
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
          <div class="col-sm-6" style="text-align:right;">
            <a class="btn btn-primary" href="{{ route('admin.admin_list_add') }}">Add New Admin List</a>
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
                <h3 class="card-title"Search Admin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="get">
                @csrf
                <div class="card-body">
                  <div class="row">
                  <div class="form-group col-md-3">
                        <label>Name</label>
                        <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name"  placeholder="Name">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="{{ Request::get('email') }}"  placeholder="Email">
                    </div>
                    <div class="form-group col-md-3">
                        <label>date</label>
                        <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}"  placeholder="Email">
                    </div>
                    <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                        <a href="{{ url('admin/admin_list') }}" class="btn btn-primary" style="margin-top: 30px;">Clear</a>
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
                <h3 class="card-title">Admin List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($getRecord as $data)
                      <tr>
                      <td>{{ $data->id }}</td> 
                      <td>{{ $data->name }}</td> 
                      <td>{{ $data->email}}</td> 
                      <td>{{ date('d-m-Y h:i A', strtotime($data->created_at)) }}</td>
                      <td>
                      <a href="{{ url('admin/edit/'.$data->id) }}" class="btn btn-primary">Edit</a> 
                      <!-- <a href="{{ url('admin/delete/'.$data->id) }}" class="btn btn-danger">Delete</a>  -->
                      
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
        <!-- /.row -->
       
        <!-- /.row -->
   
        <!-- /.row -->
    
        <!-- /.row -->

        <!-- /.row -->
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

