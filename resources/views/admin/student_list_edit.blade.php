
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
                <h3 class="card-title">Edit Student List</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

                <form action="{{ route('admin.update_student', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                 <div class="card-body">   
                    <div class="form-group">
                        <label for="admissionNumber">Admission Number</label>
                        <input type="text" class="form-control" id="admissionNumber" name="admission_number" value="{{ old('admission_number', $student->admission_number) }}" >
                        @error('admission_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
   
                    <div class="form-group">
                        <label for="rollNumber">Roll Number</label>
                        <input type="text" class="form-control" id="rollNumber" name="roll_number" value="{{ old('roll_number', $student->roll_number) }}" >
                        @error('roll_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="class">Class</label>
                        <select class="form-control" id="class" name="class_id">
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>
                                    {{ $class->class_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('class_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" value="{{ old('first_name', $student->first_name) }}" >
                        @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" value="{{ old('last_name', $student->last_name) }}" >
                        @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">  
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $student->gender == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="d_o_b" value="{{ old('d_o_b', $student->d_o_b) }}" >
                        @error('d_o_b')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="caste">Caste</label>
                        <input type="text" class="form-control" id="caste" name="caste" value="{{ old('caste', $student->caste) }}">
                        @error('caste')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="religion">Religion</label>
                        <select class="form-control" id="religion" name="religion">
                            <option value="">Select Religion</option>
                            <option value="Hindu" {{ $student->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Muslim" {{ $student->religion == 'Muslim' ? 'selected' : '' }}>Muslim</option>
                            <option value="Christian" {{ $student->religion == 'Christian' ? 'selected' : '' }}>Christian</option>
                            <option value="Other" {{ $student->religion == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('religion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="mobileNumber">Mobile Number</label>
                        <input type="text" class="form-control" id="mobileNumber" name="mobile_number" value="{{ old('mobile_number', $student->mobile_number) }}" >
                        @error('mobile_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="admissionDate">Admission Date</label>
                        <input type="date" class="form-control" id="admissionDate" name="admission_date" value="{{ old('admission_date', $student->admission_date) }}" >
                        @error('admission_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="profilePic">Profile Picture</label>
                        <input type="file" class="form-control" id="profilePic" name="profile_pic">
                        @error('profile_pic')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="bloodGroup">Blood Group</label>
                        <select class="form-control" id="bloodGroup" name="blood_group">
                            <option value="">Select Blood Group</option>
                            <option value="A+" {{ $student->blood_group == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-" {{ $student->blood_group == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+" {{ $student->blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-" {{ $student->blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="AB+" {{ $student->blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-" {{ $student->blood_group == 'AB-' ? 'selected' : '' }}>AB-</option>
                            <option value="O+" {{ $student->blood_group == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-" {{ $student->blood_group == 'O-' ? 'selected' : '' }}>O-</option>
                        </select>
                        @error('blood_group')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="height">Height (in cm)</label>
                        <input type="number" step="0.01" class="form-control" id="height" name="height" value="{{ old('height', $student->height) }}">
                        @error('height')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="weight">Weight (in kg)</label>
                        <input type="number" step="0.01" class="form-control" id="weight" name="weight" value="{{ old('weight', $student->weight) }}">
                        @error('weight')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $student->user->email) }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                            <option value="0" {{ $student->status == 0 ? 'selected' : '' }}>Active</option>
                            <option value="1" {{ $student->status == 1 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update Student</button>
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

