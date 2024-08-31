@extends('backend.layouts.app')

@section('content')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Mark Grade</h1>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Mark Grade</h3>
                    </div>
                    <form method="POST" action="{{ route('admin.mark_grade_add') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="grade_name">Grade Name</label>
                                <input type="text" class="form-control" id="grade_name" name="grade_name" required>
                            </div>
                            <div class="form-group">
                                <label for="percent_from">Percent From</label>
                                <input type="number" class="form-control" id="percent_from" name="percent_from" required>
                            </div>
                            <div class="form-group">
                                <label for="percent_to">Percent To</label>
                                <input type="number" class="form-control" id="percent_to" name="percent_to" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
