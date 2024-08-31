
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
                <h3 class="card-title">Edit Teacher</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Teacher Name</label>
                        <input type="text" class="form-control" id="teacher_name" name="name" value="{{ old('teacher_name', $teacher->name) }}">
                    </div>

                    <div class="form-group">
                        <label for="marital_status">Marital Status</label>
                        <select class="form-control" id="marital_status" name="marital_status">
                            <option value="Single" {{ $teacher->marital_status == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ $teacher->marital_status == 'Married' ? 'selected' : '' }}>Married</option>
                            <option value="Divorced" {{ $teacher->marital_status == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="qualification">Qualification</label>
                        <input type="text" class="form-control" id="qualification" name="qualification" value="{{ old('qualification', $teacher->qualification) }}">
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="male" {{ $teacher->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $teacher->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $teacher->gender == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="d_o_b">Date of Birth</label>
                        <input type="date" class="form-control" id="d_o_b" name="d_o_b" value="{{ old('d_o_b', $teacher->d_o_b) }}">
                    </div>

                    <div class="form-group">
                        <label for="c_address">Current Address</label>
                        <textarea class="form-control" id="c_address" name="c_address">{{ old('c_address', $teacher->c_address) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="p_address">Permanent Address</label>
                        <textarea class="form-control" id="p_address" name="p_address">{{ old('p_address', $teacher->p_address) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="religion">Religion</label>
                        <input type="text" class="form-control" id="religion" name="religion" value="{{ old('religion', $teacher->religion) }}">
                    </div>

                    <div class="form-group">
                        <label for="mobile_number">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ old('mobile_number', $teacher->mobile_number) }}">
                    </div>

                    <div class="form-group">
                        <label for="d_o_j">Date of Joining</label>
                        <input type="date" class="form-control" id="d_o_j" name="d_o_j" value="{{ old('d_o_j', $teacher->d_o_j) }}">
                    </div>

                    <div class="form-group">
                        <label for="profile_pic">Profile Picture</label>
                        <input type="file" class="form-control" id="profile_pic" name="profile_pic">
                    </div>

                    <div class="form-group">
                        <label for="experience">Experience</label>
                        <input type="text" class="form-control" id="experience" name="experience" value="{{ old('experience', $teacher->experience) }}">
                    </div>

                    <div class="form-group">
                        <label for="note">Note</label>
                        <input type="text" class="form-control" id="note" name="note" value="{{ old('note', $teacher->note) }}">
                    </div>

                    <div class="form-group">
                        <label for="blood_group">Blood Group</label>
                        <input type="text" class="form-control" id="blood_group" name="blood_group" value="{{ old('blood_group', $teacher->blood_group) }}">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $teacher->user->email) }}">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank if you don't want to change">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="0" {{ $teacher->status == 0 ? 'selected' : '' }}>Active</option>
                            <option value="1" {{ $teacher->status == 1 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Teacher</button>
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

