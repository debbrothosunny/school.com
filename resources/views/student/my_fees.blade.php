@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <h1>My Fees</h1>

        <!-- Display success message if any -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Display student name -->
  

        <!-- Display student information -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Remaining Amount</th>
                    <th>Payment Type</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feesCollection as $fees)
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($fees->created_at)) }}</td>
                        <td>৳{{ number_format($fees->total_amount, 2) }}</td>
                        <td>
                            @if($fees->remaining_amount == 0)
                                Paid
                            @else
                            ৳{{ number_format($fees->paid_amount, 2) }}
                            @endif
                        </td>
                        <td>৳{{ number_format($fees->remaining_amount, 2) }}</td>
                        <td>{{ $fees->payment_type }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No fees records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
