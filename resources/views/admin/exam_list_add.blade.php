
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
                <h3 class="card-title">Add New Exam</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form action="" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Exam Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="exam_name" placeholder="Enter Exam Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Note</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="note" placeholder="Enter Note">
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

