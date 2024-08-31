@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>My Bus Schedule</h1>
    
    @if($busSchedules->count())
    <table class="table">
        <thead>
            <tr>
                <th>Bus Number</th>
                <th>Route Name</th>
                <th>Driver Name</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($busSchedules as $schedule)
            <tr>
                <td>{{ $schedule->bus_number }}</td>
                <td>{{ $schedule->route_name }}</td>
                <td>{{ $schedule->driver_name }}</td>
                <td>{{ $schedule->start_time }}</td>
                <td>{{ $schedule->end_time }}</td>
                <td>{{ $schedule->status ? 'Active' : 'Inactive' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No bus schedules available for you.</p>
    @endif
</div>
@endsection
