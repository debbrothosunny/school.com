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

            <!-- Total Subjects -->
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-book"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Total Subjects</span>
                      <span class="info-box-number">{{ $subjects }}</span>
                      <a href="{{ route('student.my_subject') }}" class="text-sm">View Subjects</a>
                  </div>
              </div>
            </div>

            <!-- Exam Schedule -->
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-alt"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Exam Schedule</span>
                      <span class="info-box-number">{{ $examSchedules }}</span>
                      <a href="{{ route('student.my_exam_schedule') }}" class="text-sm">View Exam Schedule</a>
                  </div>
              </div>
            </div>

            <!-- Attendance -->
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-check-circle"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Attendance</span>
                      <span class="info-box-number">{{ $attendances }}</span>
                      <a href="{{ route('student.my_attendance') }}" class="text-sm">View Attendance</a>
                  </div>
              </div>
            </div>

            <!-- Total Fees -->
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-bill-wave"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Total Fees</span>
                      <span class="info-box-number">৳{{ $fees }}</span>
                      <a href="{{ route('student.my_fees') }}" class="text-sm">View Fees</a>
                  </div>
              </div>
            </div>

            <!-- Total Notices -->
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-bell"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Total Notices</span>
                      <span class="info-box-number">{{ $notices }}</span>
                      <a href="{{ route('student.my_notice_board_list') }}" class="text-sm">View Notices</a>
                  </div>
              </div>
            </div>

          <!-- Add other info boxes as needed -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
