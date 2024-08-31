
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
                        <label for="name">Parent Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $parent->name }}">
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" class="form-control">{{ $parent->address }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" class="form-control">
                            <option value="male" {{ $parent->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $parent->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $parent->gender == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mobile_number">Mobile Number</label>
                        <input type="text" name="mobile_number" class="form-control" value="{{ $parent->mobile_number }}">
                    </div>

                    <div class="form-group">
                        <label for="occupation">Occupation</label>
                        <input type="text" name="occupation" class="form-control" value="{{ $parent->occupation }}">
                    </div>

                    <div class="form-group">
                        <label for="profile_pic">Profile Picture</label>
                        <input type="file" name="profile_pic" class="form-control">
                        @if($parent->profile_pic)
                            <img src="{{ asset('uploads/profile_pics/' . $parent->profile_pic) }}" alt="Profile Picture" width="100">
                        @endif
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

