
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
                <h3 class="card-title">Edit Exam List</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                 <div class="card-body">
                    <div class="form-group">
                        <label for="firstName">Exam Name</label>
                        <input type="text" class="form-control" id="firstName" name="exam_name" value="{{ old('exam_name', $exams->exam_name) }}" >
                        @error('exam_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="lastName">Note</label>
                        <input type="text" class="form-control" id="lastName" name="note" value="{{ old('note', $exams->note) }}" >
                        @error('note')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="0" {{ $exams->status == 0 ? 'selected' : '' }}>Active</option>
                            <option value="1" {{ $exams->status == 1 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Exam List</button>
                </div>
                 </form>


             
             </div>
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

