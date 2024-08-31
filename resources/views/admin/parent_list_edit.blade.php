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
                <h3 class="card-title">Edit Parent</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->


              <div class="card-body">
                <form action="{{ route('admin.parent.update', $parent->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $parent->name) }}" required>
                    @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $parent->user->email) }}">
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $parent->address) }}" required>
                    @error('address')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="profile_pic">Profile Picture</label>
                    <input type="file" class="form-control-file @error('profile_pic') is-invalid @enderror" id="profile_pic" name="profile_pic">
                    @error('profile_pic')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if($parent->profile_pic)
                      <div class="mt-2">
                        <img src="{{ asset('upload/profile/' . $parent->profile_pic) }}" alt="Profile Picture" width="100">
                      </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                      <option value="male" {{ old('gender', $parent->gender) == 'male' ? 'selected' : '' }}>Male</option>
                      <option value="female" {{ old('gender', $parent->gender) == 'female' ? 'selected' : '' }}>Female</option>
                      <option value="other" {{ old('gender', $parent->gender) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                      <label for="student_id">Student</label>
                      <select class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" required>
                          <option value="">Select Student</option>
                          @foreach($students as $student)
                              <option value="{{ $student->id }}" {{ (old('student_id') ?? $parent->student_id) == $student->id ? 'selected' : '' }}>
                                  {{ $student->first_name }} {{ $student->last_name }}
                              </option>
                          @endforeach
                      </select>
                      @error('student_id')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>

                  <div class="form-group">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" id="mobile_number" name="mobile_number" value="{{ old('mobile_number', $parent->mobile_number) }}" required>
                    @error('mobile_number')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="occupation">Occupation</label>
                    <input type="text" class="form-control @error('occupation') is-invalid @enderror" id="occupation" name="occupation" value="{{ old('occupation', $parent->occupation) }}" required>
                    @error('occupation')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                      <option value="1" {{ old('status', $parent->status) == 1 ? 'selected' : '' }}>Inactive</option>
                      <option value="0" {{ old('status', $parent->status) == 0 ? 'selected' : '' }}>Active</option>
                    </select>
                    @error('status')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="{{ route('admin.parent_list') }}" class="btn btn-default">Cancel</a>
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
