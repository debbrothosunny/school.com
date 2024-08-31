@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Dashboard</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <!-- Today's Received Payment -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-calendar-day"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Today's Received Payment</span>
                    <span class="info-box-number text-primary">৳{{ number_format($todayReceivedPayment, 2) }}</span>
                </div>
            </div>
          </div>

          <!-- This Month's Received Payment -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">This Month's Received Payment</span>
                    <span class="info-box-number text-success">৳{{ number_format($monthReceivedPayment, 2) }}</span>
                </div>
            </div>
          </div>

          <!-- All-Time Received Payment -->   
          <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-calendar-alt"></i></span>
                  <div class="info-box-content">
                      <span class="info-box-text">All-Time Received Payment</span>
                      <span class="info-box-number text-warning">৳{{ number_format($allTimeReceivedPayment, 2) }}</span>
                  </div>
              </div>
          </div>

          <!-- Total Students -->
            <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-graduation-cap"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Students</span>
                            <span class="info-box-number text-danger">{{ $totalStudents }}</span>
                        </div>
                    </div>
            </div>

          <!-- Total Teachers -->
          <div class="col-12 col-sm-12 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-chalkboard-teacher"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Teachers</span>
                <span class="info-box-number text-primary">{{ $totalTeachers }}</span>
                <a href="{{ route('admin.teacher_list') }}" class="text-sm">View Teacher</a>
              </div>
            </div>
          </div>

          <!-- Total Parents -->
          <div class="col-12 col-sm-12 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-user-friends"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Parents</span>
                <span class="info-box-number text-secondary">{{ $totalParents }}</span>
                <a href="{{ route('admin.parent_list') }}" class="text-sm">View Parent</a>
              </div>
            </div>
          </div>

          <!-- Total Classes -->
          <div class="col-12 col-sm-12 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-chalkboard"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Classes</span>
                <span class="info-box-number text-dark">{{ $totalClasses }}</span>
                <a href="{{ route('admin.class_list') }}" class="text-sm">View Class</a>
              </div>
            </div>
          </div>

          <!-- Total Subjects -->
          <div class="col-12 col-sm-12 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-book"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Subjects</span>
                <span class="info-box-number text-danger">{{ $totalSubjects }}</span>
                <a href="{{ route('admin.subject_list') }}" class="text-sm">View Subject</a>
              </div>
            </div>
          </div>

          <!-- Total Exams -->
          <div class="col-12 col-sm-12 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Exams</span>
                <span class="info-box-number text-warning">{{ $totalExams }}</span>
                <a href="{{ route('admin.exam_list') }}" class="text-sm">View Exam</a>
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
