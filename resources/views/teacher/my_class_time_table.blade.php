@extends('backend.layouts.app')

@section('content')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Class Timetable</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Class Timetable</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Class Name</th>
                                            <th>Subject Name</th>
                                            <th>Week Name</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Room Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($timeTables as $timeTable)
                                            <tr>
                                                <td>{{ $timeTable->className->class_name ?? 'N/A'}}</td>
                                                <td>{{ $timeTable->subject->subject_name ?? 'N/A'}}</td>
                                                <td>{{ $timeTable->week->week_name ?? 'N/A'}}</td>
                                                <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $timeTable->start_time)->format('h:i A') }}</td>
                                                <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $timeTable->end_time)->format('h:i A') }}</td>
                                                <td>{{ $timeTable->room_number }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if($timeTables->isEmpty())
                            <div class="alert alert-warning mt-3">
                                No timetables found.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
