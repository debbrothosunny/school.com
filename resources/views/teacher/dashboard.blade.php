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

            <!-- Total Class and Subject -->
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-chalkboard-teacher"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Total Class and Subject</span>
                      <span class="info-box-number">{{ $teacherClasses }}</span>
                      <a href="{{ route('teacher.my_class_subject') }}" class="text-sm">View Classes and Subjects</a>
                  </div>
              </div>
            </div>

            <!-- Total Students -->
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-graduation-cap"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Total Students</span>
                      <span class="info-box-number">{{ $teacherStudents }}</span>
                      <a href="{{ route('teacher.my_student') }}" class="text-sm">View Students</a>
                  </div>
              </div>
            </div>

            <!-- Notice Board -->
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-bullhorn"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">Notice Board</span>
                      <span class="info-box-number">{{ $getRecord }}</span>
                      <a href="{{ route('teacher.my_notice_board_list') }}" class="text-sm">View Notices</a>
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
