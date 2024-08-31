@extends('backend.layouts.app')
@section('content')
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  </nav>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assign Subject List</h1>
          </div>
          <div class="col-sm-6" style="text-align:right;">
            <a class="btn btn-primary" href="{{ route('admin.assign_subject_list_add') }}">Add New Assign Subject List</a>
          </div>
        </div>
      </div>
    </section>
    
    <section class="content"> 
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Search Assign Class</h3>
              </div>
              <form action="{{ url('admin/assign_subject_list') }}" method="GET">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label>Class Name</label>
                      <input type="text" class="form-control" value="{{ Request::get('class_name') }}" name="class_name" placeholder="Class Name">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Subject Name</label>
                      <input type="text" class="form-control" value="{{ Request::get('subject_name') }}" name="subject_name" placeholder="Subject Name">
                    </div>
                    <div class="form-group col-md-3">
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                      <a href="{{ url('admin/assign_subject_list') }}" class="btn btn-primary" style="margin-top: 30px;">Clear</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Assign Subject List</h3>
              </div>
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Class Name</th>
                      <th>Subject Name</th>
                      <th>Created By Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($classSubjects as $data)
                      <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->class->class_name ?? 'Unknown' }}</td>
                        <td>{{ $data->subject->subject_name ?? 'Unknown' }}</td>
                        <td>{{ $data->creator->name ?? 'Unknown' }}</td>
                        <td>{{ $data->status == 0 ? 'Active' : 'Inactive' }}</td>
                        <td>
                          <p class="btn btn-sm {{ $data->status == 0 ? 'btn-primary' : 'btn-success' }} mb-0">
                            {{ $data->status == 0 ? 'Active' : 'Inactive' }}
                          </p>
                        </td>
                        <td>
                          <a href="{{ url('admin/assign_subject_list_edit/edit/'.$data->id) }}" class="btn btn-primary">Edit</a> 
                          <form id="delete-form-{{ $data->id }}" action="{{ route('admin.assign_subject_list.delete', $data->id) }}" method="get" style="display: inline;">
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
              {{ $classSubjects->links() }}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>



  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
@endsection
