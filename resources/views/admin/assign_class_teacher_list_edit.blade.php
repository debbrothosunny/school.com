@extends('backend.layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Assign Class Teacher</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->


                        <div class="card-body">
                            <form action="{{ route('assign_class_teacher.update', $assignment->id) }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="class_id">Class Name</label>
                                        <select name="class_id" id="class_id" class="form-control">
                                            @foreach($classes as $class)
                                                <option value="{{ $class->id }}" {{ $class->id == $assignment->class_id ? 'selected' : '' }}>{{ $class->class_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="teacher_id">Teacher Name</label>
                                        <select name="teacher_id" id="teacher_id" class="form-control">
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" {{ $teacher->id == $assignment->teacher_id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Subject Name</label>
                                        @foreach($subjects as $subject)
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="subject_id[]" value="{{ $subject->id }}"
                                                        {{ $assignment->subjects->contains('id', $subject->id) ? 'checked' : '' }}>
                                                    {{ $subject->subject_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div> -->
                                    <div class="form-group">
                                        <label style="color:#c6b6b6;">Status*</label>
                                        <select class="form-control" name="status">
                                            <option value="0" {{ $assignment->status == 0 ? 'selected' : '' }}>Active</option>
                                            <option value="1" {{ $assignment->status == 1 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('admin.assign_class_teacher_list') }}" class="btn btn-default">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>




@endsection
