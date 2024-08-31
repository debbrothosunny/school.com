@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Bus Schedule</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('bus_schedules.update', $busSchedule->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="class_id">Class</label>
                                    <select name="class_id" class="form-control">
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}" {{ $busSchedule->class_id == $class->id ? 'selected' : '' }}>
                                                {{ $class->class_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('class_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="bus_number">Bus Number</label>
                                    <input type="text" class="form-control" id="bus_number" name="bus_number" 
                                           value="{{ old('bus_number', $busSchedule->bus_number) }}" required>
                                    @error('bus_number')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="route_name">Route Name</label>
                                    <input type="text" class="form-control" id="route_name" name="route_name"
                                           value="{{ old('route_name', $busSchedule->route_name) }}" required>
                                    @error('route_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="driver_name">Driver Name</label>
                                    <input type="text" class="form-control" id="driver_name" name="driver_name"
                                           value="{{ old('driver_name', $busSchedule->driver_name) }}" required>
                                    @error('driver_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="start_time">Start Time</label>
                                    <input type="time" class="form-control" id="start_time" name="start_time"
                                           value="{{ old('start_time', $busSchedule->start_time) }}" required>
                                    @error('start_time')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="end_time">End Time</label>
                                    <input type="time" class="form-control" id="end_time" name="end_time"
                                           value="{{ old('end_time', $busSchedule->end_time) }}" required>
                                    @error('end_time')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="start_location">Start Location</label>
                                    <input type="text" class="form-control" id="start_location" name="start_location"
                                           value="{{ old('start_location', $busSchedule->start_location) }}" required>
                                    @error('start_location')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="end_location">End Location</label>
                                    <input type="text" class="form-control" id="end_location" name="end_location"
                                           value="{{ old('end_location', $busSchedule->end_location) }}" required>
                                    @error('end_location')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="days_of_operation">Days of Operation</label>
                                    <input type="text" class="form-control" id="days_of_operation" name="days_of_operation"
                                           value="{{ old('days_of_operation', $busSchedule->days_of_operation) }}" required>
                                    @error('days_of_operation')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="capacity">Capacity</label>
                                    <input type="number" class="form-control" id="capacity" name="capacity"
                                           value="{{ old('capacity', $busSchedule->capacity) }}" required>
                                    @error('capacity')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="contact_number">Contact Number</label>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number"
                                           value="{{ old('contact_number', $busSchedule->contact_number) }}" required>
                                    @error('contact_number')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="0" {{ $busSchedule->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        <option value="1" {{ $busSchedule->status == 1 ? 'selected' : '' }}>Active</option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <textarea class="form-control" id="remarks" name="remarks">{{ old('remarks', $busSchedule->remarks) }}</textarea>
                                    @error('remarks')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- SweetAlert2 notification script -->
@if(session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK',
        });
    </script>
@endif
@endsection
