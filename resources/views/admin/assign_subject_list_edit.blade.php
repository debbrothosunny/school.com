
@extends('backend.layouts.app')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Assign Subject</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form ction="{{ url('') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="class_id">Class Name</label>
                        <select class="form-control" name="class_id" required>
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ $class->id == $classSubject->class_id ? 'selected' : '' }}>
                                    {{ $class->class_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Subject Names</label>
                        @foreach($subjects as $subject)
                            <div>
                                <label>
                                    <input type="checkbox" name="subject_id[]" value="{{ $subject->id }}" 
                                    {{ in_array($subject->id, $getAssignSubjectID) ? 'checked' : '' }}>
                                    {{ $subject->subject_name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label style="color:#c6b6b6;">Status*</label>
                        <select class="form-control" name="status">
                          <option value="0" {{ $class->status == 0 ? 'selected' : '' }}>Active</option>
                          <option value="1" {{ $class->status == 1 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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

