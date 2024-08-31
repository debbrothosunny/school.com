<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ !empty($header_title) ? $header_title : ''}} - School</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ url('public/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">


  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('public/dist/css/adminlte.min.css') }}">

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">


  <!-- sweet alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @yield('style')
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="{{ url('public/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
    </div> -->

    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="" class="brand-link">
        <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">School Management System</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <!-- @php
            $profilePic = auth()->user()->profile_pic 
                ? asset('storage/profile/' . auth()->user()->profile_pic) 
                : asset('upload/to/upload/image.jpg');
            @endphp
            <div class="image">
                <img src="{{ $profilePic }}" class="img-circle elevation-2" alt="Profile Picture" width="100" height="100">
            </div> -->
            <div class="info text-center ml-3">
                <a href="#" class="d-block"><i class="fas fa-user mr-2"></i>{{ Auth::user()->name }}</a>
            </div>
          </div>

        

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            @if(Auth::user()->user_type == 1)
            <li class="nav-item">
              <a href="{{ route('admin.dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                <i class="nav-icon fas fa-bell"></i>
                <p>
                  Dashboard
                  <span class="badge badge-info right"></span>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.admin_list')}}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Admin
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.teacher_list')}}" class="nav-link @if(Request::segment(2) == 'teacher') active @endif">
                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                <p>
                  Teacher
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.student_list')}}" class="nav-link @if(Request::segment(2) == 'student') active @endif">
                 <i class="nav-icon fas fa-users"></i>
                <p>
                  Student
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.parent_list')}}" class="nav-link @if(Request::segment(2) == 'Parent') active @endif">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Parent
                </p>
              </a>
            </li>


            <!-- Academics -->
            <li class="nav-item @if(Request::segment(2) == 'class_list' || Request::segment(2) == 'subject_list' || Request::segment(2) == 'assign_subject_list' || Request::segment(2) == 'assign_class_teacher_list')|| Request::segment(2) == 'class_time_table_list') menu-is-opening menu-open @endif">

              <a href="#" class="nav-link @if(Request::segment(2) == 'class_list' || Request::segment(2) == 'subject_list' || Request::segment(2) == 'assign_subject_list' || Request::segment(2) == 'assign_class_teacher_list') || Request::segment(2) == 'class_time_table_list') active @endif">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Academics
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.class_list')}}" class="nav-link @if(Request::segment(2) == 'class_list') active @endif">
                    <i class="fas fa-school nav-icon"></i>
                    <p>Class</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{route('admin.subject_list')}}" class="nav-link @if(Request::segment(2) == 'subject_list') active @endif">
                    <i class="fas fa-book-open nav-icon"></i>
                    <p>Subject</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{route('admin.assign_subject_list')}}" class="nav-link @if(Request::segment(2) == 'assign_subject_list') active @endif">
                    <i class="fas fa-tasks nav-icon"></i>
                    <p>Assign Subject</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('admin.assign_class_teacher_list') }}" class="nav-link @if(Request::segment(2) == 'assign_class_teacher_list') active @endif">
                    <i class="fas fa-chalkboard-teacher nav-icon"></i>
                    <p>Assign Class Teacher</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{route('admin.class_time_table_list')}}" class="nav-link @if(Request::segment(2) == 'class_time_table_list') active @endif">
                    <i class="fas fa-calendar-alt nav-icon"></i>
                    <p>Class Time Table</p>
                  </a>
                </li>

                
              </ul>
            </li>


            <!-- Examination -->
            <li class="nav-item @if(Request::segment(2) == 'exam_list'|| Request::segment(2) == 'exam_schedule'|| Request::segment(2) == 'mark_register'|| Request::segment(2) == 'mark_grade'|| Request::segment(2) == 'result') menu-is-opening menu-open @endif">

              <a href="#" class="nav-link @if(Request::segment(2) == 'exam_list')  active @endif">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                  Examination
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.exam_list')}}" class="nav-link @if(Request::segment(2) == 'exam_list') active @endif">
                    <i class="nav-icon fas fa-list-ul"></i>
                    <p>Exam List</p>
                  </a>
                </li>
              </ul>

              
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.exam_schedule')}}" class="nav-link @if(Request::segment(2) == 'exam_schedule') active @endif">
                    <i class="nav-icon fas fa-clock"></i>
                    <p>Exam Schedule</p>
                  </a>
                </li>

              </ul>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.mark_register')}}" class="nav-link @if(Request::segment(2) == 'mark_register') active @endif">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Mark Register</p>
                  </a>
                </li>
              </ul>

              <!-- <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="" class="nav-link @if(Request::segment(2) == 'saved_marks') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Saved Mark</p>
                  </a>
                </li>
              </ul> -->

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.mark_grade')}}" class="nav-link @if(Request::segment(2) == 'mark_grade') active @endif">
                    <i class="nav-icon fas fa-chart-line"></i>
                    <p>Mark Grade</p>
                  </a>
                </li>
              </ul>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.result')}}" class="nav-link @if(Request::segment(2) == 'result') active @endif">
                    <i class="nav-icon fas fa-check-square"></i>
                    <p>Result</p>
                  </a>
                </li>
              </ul>
            </li>


            <!-- Attendence -->
            <li class="nav-item @if(Request::segment(2) == 'student_attendance'|| Request::segment(2) == 'attendance_report') menu-is-opening menu-open @endif">

              <a href="#" class="nav-link @if(Request::segment(2) == 'student_attendance')  active @endif">
                <i class="nav-icon fas fa-user-check"></i>
                <p>
                   Attendence
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.student_attendance')}}" class="nav-link @if(Request::segment(2) == 'student_attendance') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Student Attendence</p>
                  </a>
                </li>
              </ul>
              
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.attendance_report')}}" class="nav-link @if(Request::segment(2) == 'attendance_report') active @endif">
                    <i class="fas fa-file-alt nav-icon"></i>
                    <p>Attendence Report</p>
                  </a>
                </li>
              </ul>
            </li>


            <!-- Communicate -->
            <li class="nav-item @if(Request::segment(2) == 'communicate') menu-is-opening menu-open @endif">

              <a href="#" class="nav-link @if(Request::segment(2) == 'communicate')  active @endif">
                <i class="nav-icon fas fa-comments"></i>
                <p>
                Communicate
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.notice_board_list')}}" class="nav-link @if(Request::segment(2) == 'notice_board_list') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Notice Board</p>
                  </a>
                </li>
              </ul>
            </li>


            <!-- Home Work -->
            <li class="nav-item @if(Request::segment(2) == 'homework'|| Request::segment(2) == 'admin_submitted_homework') menu-is-opening menu-open @endif">

              <a href="#" class="nav-link @if(Request::segment(2) == 'homework')  active @endif">
                <i class="nav-icon fas fa-book"></i>
                <p>
                Home Work
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.homework')}}" class="nav-link @if(Request::segment(2) == 'homework') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Home Work List</p>
                  </a>
                </li>
              </ul>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.admin_submitted_homework')}}" class="nav-link @if(Request::segment(2) == 'admin_submitted_homework') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Submitted Home Work </p>
                  </a>
                </li>

              </ul>
            </li>

            <!-- Fees Collection -->
            <li class="nav-item @if(Request::segment(2) == 'fees_collection') menu-is-opening menu-open @endif">

              <a href="#" class="nav-link @if(Request::segment(2) == 'fees_collection')  active @endif">
                <i class="nav-icon fas fa-money-bill"></i>
                <p>
                  Fees Collection
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.fees_collection')}}" class="nav-link @if(Request::segment(2) == 'fees_collection') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Collect Fees</p>
                  </a>
                </li>

              </ul>
            </li>

            <!-- Bus Schdeule -->

            <li class="nav-item @if(Request::segment(2) == 'admin.bus_schedule_list') menu-is-opening menu-open @endif">

              <a href="#" class="nav-link @if(Request::segment(2) == 'admin.bus_schedule_list')  active @endif">
                  <i class="nav-icon fas fa-bus"></i> 
                  <p>
                      Bus Schedule 
                      <i class="fas fa-angle-left right"></i>
                  </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.bus_schedule_list')}}" class="nav-link @if(Request::segment(2) == 'admin.bus_schedule_list') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bus Schdeule</p>
                  </a>
                </li>

              </ul>
            </li>

            <!-- Library-->
            <li class="nav-item @if(Request::segment(2) == 'admin.library_list') menu-is-opening menu-open @endif">

              <a href="#" class="nav-link @if(Request::segment(2) == 'admin.library_list')  active @endif">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    Library
                      <i class="fas fa-angle-left right"></i>
                  </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.library_list')}}" class="nav-link @if(Request::segment(2) == 'admin.library_list') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Library</p>
                  </a>
                </li>

              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.booking_list')}}" class="nav-link @if(Request::segment(2) == 'admin.booking_list') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Booking List</p>
                  </a>
                </li>

              </ul>
            </li>



            <!-- Setting -->
            <li class="nav-item @if(Request::segment(2) == 'setting') menu-is-opening menu-open @endif">

              <a href="#" class="nav-link @if(Request::segment(2) == 'setting')  active @endif">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Setting
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.setting')}}" class="nav-link @if(Request::segment(2) == 'setting') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Setting</p>
                  </a>
                </li>
              </ul>
            </li>



            <!-- <li class="nav-item">
              <a href="{{ route('admin.assign_class_teacher_list') }}" class="nav-link @if(Request::segment (2) == 'assign_class_teacher_list') active @endif">
              <i class="nav-icon far fa-image"></i>
              <p>
                Assign Class Teacher
              </p>
              </a>
            </li> -->

            <li class="nav-item">
              <a href="{{route('admin.change_password')}}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                <i class="nav-icon fas fa-lock"></i>
                <p>
                  Change Password
                </p>
              </a>
            </li>

            @elseif(Auth::user()->user_type == 2)
            <li class="nav-item">
              <a href="{{route('teacher.dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('teacher.my_account')}}" class="nav-link @if(Request::segment(2) == 'my_account') active @endif">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  My Account
                  <span class="badge badge-info right"></span>
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('teacher.my_class_subject')}}" class="nav-link @if(Request::segment(2) == 'my_class_subject') active @endif">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  My Class & Subject
                  <span class="badge badge-info right"></span>
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('teacher.my_student')}}" class="nav-link @if(Request::segment(2) == 'my_student') active @endif">
                <i class="nav-icon fas fa-user-graduate"></i>
                <p>
                  My Student
                  <span class="badge badge-info right"></span>
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('teacher.my_exam_schedule')}}" class="nav-link @if(Request::segment(2) == 'my_exam_schedule') active @endif">
                <i class="nav-icon fas fa-calendar-check"></i>
                <p>
                  My Exam Schedule
                  <span class="badge badge-info right"></span>
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('teacher.student_attendance_report')}}" class="nav-link @if(Request::segment(2) == 'student_attendance_report') active @endif">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                    Attendance Report
                  <span class="badge badge-info right"></span>
                </p>
              </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('teacher.my_notice_board_list') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board_list') active @endif">
                    <i class="nav-icon fas fa-bullhorn"></i>
                    <p>
                        My Notice Board
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>

            <!-- Home Work -->
            <li class="nav-item @if(Request::segment(2) == 'homework') menu-is-opening menu-open @endif">
                <a href="#" class="nav-link @if(Request::segment(2) == 'homework')  active @endif">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Home Work
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('teacher.teacher_home_work')}}" class="nav-link @if(Request::segment(2) == 'teacher_home_work') active @endif">
                            <i class="far fa-edit nav-icon"></i>
                            <p>Home Work</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('teacher.teacher_submitted_homework')}}" class="nav-link @if(Request::segment(2) == 'teacher_submitted_homework') active @endif">
                            <i class="far fa-check-square nav-icon"></i>
                            <p>Submitted Home Work</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{route('teacher.change_password')}}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                    <i class="nav-icon fas fa-key"></i>
                    <p>
                        Change Password
                    </p>
                </a>
            </li>

            @elseif(Auth::user()->user_type == 3)
            <li class="nav-item">
                <a href="{{ route('student.dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <!-- <span class="badge badge-info right">2</span> -->
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('student.my_subject') }}" class="nav-link @if(Request::segment(2) == 'my_subject') active @endif">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        My Subject
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('student.my_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_timetable') active @endif">
                    <i class="nav-icon fas fa-clock"></i>
                    <p>
                        My Time Table
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('student.my_exam_schedule') }}" class="nav-link @if(Request::segment(2) == 'my_exam_schedule') active @endif">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>
                        My Exam Schedule
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('student.my_result') }}" class="nav-link @if(Request::segment(2) == 'my_result') active @endif">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                    <p>
                        My Result
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('student.my_attendance') }}" class="nav-link @if(Request::segment(2) == 'my_attendance') active @endif">
                    <i class="nav-icon fas fa-check"></i>
                    <p>
                        My Attendance
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('student.student_home_work') }}" class="nav-link @if(Request::segment(2) == 'student_home_work') active @endif">
                    <i class="nav-icon fas fa-pencil-alt"></i>
                    <p>
                        My Home Work
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('student.my_submitted_homework') }}" class="nav-link @if(Request::segment(2) == 'my_submitted_homework') active @endif">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>
                        Submitted Home Work
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('student.my_notice_board_list') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board_list') active @endif">
                    <i class="nav-icon fas fa-bullhorn"></i>
                    <p>
                        My Notice Board
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('student.my_account') }}" class="nav-link @if(Request::segment(2) == 'my_account') active @endif">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        My Account
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('student.my_fees') }}" class="nav-link @if(Request::segment(2) == 'my_fees') active @endif">
                    <i class="nav-icon fas fa-money-check-alt"></i>
                    <p>
                        My Fees
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('student.my_library') }}" class="nav-link @if(Request::segment(2) == 'my_library') active @endif">
                    <i class="nav-icon fas fa-money-check-alt"></i>
                    <p>
                        My Library
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('student.my_bus_schedule') }}" class="nav-link @if(Request::segment(2) == 'my_bus_schedule') active @endif">
                    <i class="nav-icon fas fa-money-check-alt"></i>
                    <p>
                        My Bus Schedule
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('student.change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                    <i class="nav-icon fas fa-key"></i>
                    <p>
                        Change Password
                    </p>
                </a>
            </li>

            @elseif(Auth::user()->user_type == 4)
            <li class="nav-item">
                <a href="{{ route('parent.dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a href="" class="nav-link @if(Request::segment(2) == 'parent_student') active @endif">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        My Student
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li> -->

            <li class="nav-item">
                <a href="{{ route('parent.my_notice_board_list') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board_list') active @endif">
                    <i class="nav-icon fas fa-bullhorn"></i>
                    <p>
                        My Notice Board
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('parent.my_student_fees') }}" class="nav-link @if(Request::segment(2) == 'my_student_fees') active @endif">
                    <i class="nav-icon fas fa-money-bill-alt"></i>
                    <p>
                        My Student Fees
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('parent.my_student_result') }}" class="nav-link @if(Route::is('parent.my_student_result')) active @endif">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                    <p>
                        My Student Result
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('parent.my_account') }}" class="nav-link @if(Request::segment(2) == 'my_account') active @endif">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        My Account
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('parent/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                    <i class="nav-icon fas fa-key"></i>
                    <p>
                        Change Password
                    </p>
                </a>
            </li>

            @endif


            <li class="nav-item">
              <a href="{{route('logout')}}"" class=" nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    include('backend/layouts.header')
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    @yield('content')

    
      

    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>

    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('backend/layouts.footer')

  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->

  <script src="{{ url('public/plugins/jquery/jquery.min.js') }}"></script>

  
  <!-- Bootstrap -->
  <script src="{{ url('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ url('public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ url('public/dist/js/adminlte.js') }}"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="{{ url('public/dist/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
  <script src="{{ url('public/dist/raphael/raphael.min.js') }}"></script>
  <script src="{{ url('public/dist/jquery-mapael/jquery.mapael.min.js') }}"></script>
  <script src="{{ url('public/dist/jquery-mapael/maps/usa_states.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ url('public/dist/chart.js/Chart.min.js') }}"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="{{ url('public/dist/js/demo.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ url('public/dist/js/pages/dashboard2.js') }}"></script>
  @yield('script')

<!-- SweetAlert2 notification script -->
@if(session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK',
            timer: 6000,
            timerProgressBar: true,
            background: '#333', // Darker background color
            color: '#fff', // Text color (white)
            iconColor: '#0f0', // Icon color (green for success)
            customClass: {
                popup: 'swal-dark-popup',
                confirmButton: 'swal-dark-button',
                title: 'swal-dark-title',
                text: 'swal-dark-text',
            }
        });
    </script>
@endif

<style>
    .swal-dark-popup {
        background-color: #2c2c2c; /* Dark background for the popup */
        color: #ffffff; /* White text color */
    }

    .swal-dark-button {
        background-color: #444; /* Darker confirm button */
        color: #ffffff; /* White text color */
    }

    .swal-dark-title {
        color: #ffffff; /* White color for the title */
    }

    .swal-dark-text {
        color: #cccccc; /* Slightly lighter text color */
    }

    .swal2-popup {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.9); /* Darker shadow */
    }
</style>

 <!-- Delete script -->

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const classId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${classId}`).submit();
                    }
                });
            });
        });
    });
  </script>
</body>

</html>