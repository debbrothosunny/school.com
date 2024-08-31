
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
            <h1>Compose</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Compose</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          @foreach($notices as $data)
          <!-- /.col -->
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                    <div class="mailbox-read-info">
                        <h5><h5>{{ $data->title }}</h5></h5>
                        <h6>
                        <span class="mailbox-read-time float-right">{{ now()->format('d M. Y h:i A') }}</span></h6>
                    </div>
                    <div class="mailbox-read-message">
                     {!! $data->message !!}
                    </div>
                    <!-- /.mailbox-read-message -->
                    </div>
                </div>
            <!-- /.card -->
            </div>
          @endforeach

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
<!-- ./wrapper -->

@endsection
