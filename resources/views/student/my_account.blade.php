
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
                <h3 class="card-title">Edit My Account</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="{{ $student->first_name }}">
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="{{ $student->last_name }}">
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" class="form-control">
                            <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $student->gender == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="d_o_b">Date of Birth</label>
                        <input type="date" name="d_o_b" class="form-control" value="{{ $student->d_o_b }}">
                    </div>

                    <div class="form-group">
                        <label for="caste">Caste</label>
                        <input type="text" name="caste" class="form-control" value="{{ $student->caste }}">
                    </div>

                    <div class="form-group">
                        <label for="religion">Religion</label>
                        <input type="text" name="religion" class="form-control" value="{{ $student->religion }}">
                    </div>

                    <div class="form-group">
                        <label for="mobile_number">Mobile Number</label>
                        <input type="text" name="mobile_number" class="form-control" value="{{ $student->mobile_number }}">
                    </div>

                    <div class="form-group">
                        <label for="profile_pic">Profile Picture</label>
                        <input type="file" name="profile_pic" class="form-control">
                        @if($student->profile_pic)
                            <img src="{{ asset('uploads/profile_pics/' . $student->profile_pic) }}" alt="Profile Picture" width="100">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="blood_group">Blood Group</label>
                        <input type="text" name="blood_group" class="form-control" value="{{ $student->blood_group }}">
                    </div>

                    <div class="form-group">
                        <label for="height">Height</label>
                        <input type="text" name="height" class="form-control" value="{{ $student->height }}">
                    </div>

                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input type="text" name="weight" class="form-control" value="{{ $student->weight }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
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

