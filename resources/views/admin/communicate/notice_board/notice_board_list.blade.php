@extends('backend.layouts.app')
@section('content')
<div class="wrapper">
  <!-- Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Notice Board List</h1>
          </div>
          <div class="col-sm-6" style="text-align:right;">
            <a class="btn btn-primary" href="{{ route('admin.notice_board_list_add') }}">Add New Notice Board</a>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Main content -->
    <section class="content"> 
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Search Notice</h3>
          </div>
          <!-- /.card-header -->   
          <!-- form start -->

          <form action="{{ route('admin.notice_board_list') }}" method="GET">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="form-group col-md-3">  
                    <label>Title</label>
                    <input type="text" class="form-control" value="{{ request('title') }}" name="title" placeholder="Title">
                </div>
                <div class="form-group col-md-3">  
                    <label>Notice Date</label>
                    <input type="date" class="form-control" value="{{ request('notice_date') }}" name="notice_date">
                </div>
                <div class="form-group col-md-3">  
                    <label>Publish Date</label>
                    <input type="date" class="form-control" value="{{ request('publish_date') }}" name="publish_date">
                </div>
                <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{ route('admin.notice_board_list') }}" class="btn btn-primary" style="margin-top: 30px;">Clear</a>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </form>
        </div>
      </div>
      
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Notice List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Notice Date</th>
                      <th>Publish Date</th>
                      <th>Message To</th>
                      <th>Message</th>
                      <th>Created By</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($notices as $data)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $data->title }}</td>
                      <td>{{ $data->notice_date }}</td>
                      <td>{{ $data->publish_date }}</td>
                      <td>
                        @foreach($data->NoticeBoardMessage as $recipient)
                          @if($recipient->message_to == 2)
                            Teacher
                          @elseif($recipient->message_to == 3)
                            Student
                          @elseif($recipient->message_to == 4)
                            Parent
                          @endif
                        @endforeach
                      </td>
                      <td>{!! Str::limit($data->message, 50) !!}</td>
                      <td>{{ $data->creator->name ?? 'Unknown' }}</td>
                      <td>
                        <a href="{{ url('admin/notice_board_list_edit/edit/'.$data->id) }}" class="btn btn-primary btn-sm">Edit</a>

                          <form id="delete-form-{{ $data->id }}" action="{{ route('admin.notice_board.delete', $data->id) }}" method="get" style="display: inline;">
                            <button type="button" class="btn btn-danger btn-delete" data-id="{{ $data->id }}">Delete</button>
                          </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>  

            <!-- Pagination Links -->
            <div class="d-flex justify-content-left">
              {{ $notices->links() }}
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
</div>
@endsection
