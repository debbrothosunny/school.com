@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <!-- Student Fees -->
            <div class="col-12 col-sm-6 col-md-6">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-money-bill-wave"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">My Student Fees</span>
                      <span class="info-box-number">৳{{ $fees }}</span>
                      <a href="{{ route('parent.my_student_fees') }}" class="text-sm">View Fees</a>
                  </div>
              </div>
            </div>

            <!-- Notice Board -->
            <div class="col-12 col-sm-6 col-md-6">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-bullhorn"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Notice Board</span>
                      <span class="info-box-number">{{ $notices }}</span>
                      <a href="{{ route('parent.my_notice_board_list') }}" class="text-sm">View Notices</a>
                  </div>
              </div>
            </div>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
