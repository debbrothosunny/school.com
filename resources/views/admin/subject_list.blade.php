@extends('backend.layouts.app')
@section('content')
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Subject List</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a class="btn btn-primary" href="{{ route('admin.subject_list_add') }}">Add New Subject</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content"> 
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Search Subject</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="get">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                        <label>Name</label>
                        <input type="text" class="form-control" value="{{ old('subject_name') }}" name="subject_name"  placeholder="Subject Name">
                    </div>
                    <!-- <div class="form-group col-md-3">
                      <label>Subject Type*</label>
                      <select name="type" class="form-control">
                          <option value="Theory" {{ (Request::get('type') == 'Theory') ? 'selected' : '' }}>Theory</option>
                          <option value="Practical" {{ (Request::get('type') == 'Practical') ? 'selected' : '' }}>Practical</option>
                      </select>
                    </div> -->
                    <div class="form-group col-md-3">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" value="{{ old('date') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                        <a href="{{ url('admin/subject_list') }}" class="btn btn-secondary" style="margin-top: 30px;">Clear</a>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Subject List Table -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Subject List</h3>
              </div>
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Subject Name</th>
                      <th>Type</th>
                      <th>Created By Name</th>
                      <th>Created At</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($getRecord as $data)
                    <tr>
                      <td>{{ $data->id }}</td>
                      <td>{{ $data->subject_name }}</td>
                      <td>{{ $data->type }}</td>
                      <td>{{ $data->created_by }}</td>
                      <td>{{ date('d-m-Y h:i A', strtotime($data->created_at)) }}</td>
                      <td>
                          @if ($data->status == 0)  
                              <p class="btn btn-sm btn-primary mb-0">Active</p>
                          @else
                              <p class="btn btn-sm btn-success mb-0">Deactive</p>
                          @endif
                      </td>
                      <td>
                        <a href="{{ url('admin/subject_list_edit/edit/'.$data->id) }}" class="btn btn-primary">Edit</a> 
                        <form id="delete-form-{{ $data->id }}" action="{{ route('admin.subject_list.delete', $data->id) }}" method="get" style="display: inline;">
                          <button type="button" class="btn btn-danger btn-delete" data-id="{{ $data->id }}">Delete</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!-- Pagination Links -->
            <div class="d-flex justify-content-left">
              {{ $getRecord->links() }}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection
