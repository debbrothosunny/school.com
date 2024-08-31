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
                            <h3 class="card-title">Add New Notice Board</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form action="{{ route('admin.notice_board_store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter Title" required>
                                </div>
                                <div class="form-group">
                                    <label for="notice_date">Notice Date</label>
                                    <input type="date" class="form-control" id="notice_date" name="notice_date"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="publish_date">Publish Date</label>
                                    <input type="date" class="form-control" id="publish_date" name="publish_date"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" id="message" name="message"
                                        placeholder="Enter Message" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label style="display: block;">Message To</label>
                                    
                                    <label style="margin-right: 50px;"><input type="checkbox" value="3"
                                            name="message_to[]"> Student</label>
                                    
                                            <label style="margin-right: 50px;"><input type="checkbox" value="4"
                                            name="message_to[]"> Parent</label>
                                            
                                    <label><input type="checkbox" value="2" name="message_to[]"> Teacher</label>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
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
