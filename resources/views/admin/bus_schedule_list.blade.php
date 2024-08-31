@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>Bus Schedules</h1>
    <a href="{{ route('admin.bus_schedule_list_create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Add New Schedule
    </a>
    @if($busSchedules->count())
    <table class="table">
        <thead>
            <tr>
                <th>Bus Number</th>
                <th>Route Name</th>
                <th>Driver Name</th>
                <th>Class</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($busSchedules as $schedule)
            <tr>
                <td>{{ $schedule->bus_number }}</td>
                <td>{{ $schedule->route_name }}</td>
                <td>{{ $schedule->driver_name }}</td>
                <td>{{ $schedule->class->class_name }}</td>
                <td>{{ $schedule->start_time }}</td>
                <td>{{ $schedule->end_time }}</td>
                <td>{{ $schedule->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('bus_schedules.edit', $schedule->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('bus_schedules.destroy', $schedule->id) }}" method="get" style="display:inline;">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>  
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $busSchedules->links() }}
    @else
    <p>No bus schedules available.</p>
    @endif
</div>
@endsection
