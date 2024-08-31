@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h1>Bookings</h1>
    
    @if($bookings->isEmpty())
        <p>No bookings found.</p>
    @else
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Book Title</th>
                    <th>Booking Date</th>
                    <th>Return Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->student->first_name }} {{ $booking->student->last_name }}</td>
                    <td>
                        @if($booking->book)
                            {{ $booking->book->book_title }}
                        @else
                            Not Available
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') }}</td>
                    <td>{{ $booking->return_date ? \Carbon\Carbon::parse($booking->return_date)->format('Y-m-d') : 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
