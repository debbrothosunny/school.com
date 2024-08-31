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
                        <h1>Edit Notice Board</h1>
                    </div>
                    <div class="col-sm-6" style="text-align:right;">
                        <a class="btn btn-primary" href="{{ route('admin.notice_board_list') }}">Back to List</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Update Notice Board</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.notice_board.update', ['id' => $notice->id]) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="{{ $notice->title }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="notice_date">Notice Date</label>
                                        <input type="date" class="form-control" id="notice_date" name="notice_date" value="{{ $notice->notice_date }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="publish_date">Publish Date</label>
                                        <input type="date" class="form-control" id="publish_date" name="publish_date" value="{{ $notice->publish_date }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" id="message" name="message" placeholder="Enter Message" required>{{ $notice->message }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Message To</label><br>
                                        <label style="margin-right: 50px;"><input type="checkbox" value="3" name="message_to[]" {{ in_array(3, $messageTo) ? 'checked' : '' }}> Student</label>
                                        <label style="margin-right: 50px;"><input type="checkbox" value="4" name="message_to[]" {{ in_array(4, $messageTo) ? 'checked' : '' }}> Parent</label>
                                        <label><input type="checkbox" value="2" name="message_to[]" {{ in_array(2, $messageTo) ? 'checked' : '' }}> Teacher</label>
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
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /.wrapper -->
@endsection
