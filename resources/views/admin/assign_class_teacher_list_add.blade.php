
@extends('backend.layouts.app')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Assign Class Teacher</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->


              <div class="card-body">
              <form action="{{ route('assign_class_teacher.add') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="class_id">Class Name</label>
                        <select name="class_id" id="class_id" class="form-control">
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="teacher_id">Teacher Name</label>
                        <select name="teacher_id" id="teacher_id" class="form-control">
                            <option value="">Select Teacher</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label>Subject Name</label>
                      @foreach($subjects as $subject)
                      <div>
                      <label>
                        <input type="checkbox" name="subject_id[]" value="{{ $subject->id }}">
                        {{ $subject->subject_name }}
                      </label>
                      </div>
                      @endforeach
                    </div>
                    <div class="form-group">
                        <label style="color:#c6b6b6;">Status*</label>
                        <select  class="form-control" name="status">
                            <option value="0">Active</option>
                            <option value="1">Inactive</option>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
              </div></div>
            </div>
            <!-- /.card -->

            <!-- general form elements -->
   
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection

