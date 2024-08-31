@extends('backend.layouts.app')
@section('content')
<div class="wrapper">

    <style>
        .text-center {
    text-align: center;
}
    </style>
    <!-- Navbar -->
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
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
                              <h3 class="card-title text-center">My Subject List</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="container">
                                    @if ($subjects->count() > 0)
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Subject Name</th>
                                                    <th>Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($subjects as $subject)
                                                    <tr>
                                                        <td>{{ $subject->subject_name }}</td>
                                                        <td>{{ $subject->type }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p>No subjects found.</p>
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
    
    <!-- /.control-sidebar -->
</div>
<!-- Content Header (Page header) -->

<!-- /.content -->
</div>

@endsection