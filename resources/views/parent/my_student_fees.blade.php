@extends('backend.layouts.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h1>My Student Fees</h1>
            </div>

            <div class="card-body">
                <!-- Display success message if any -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Iterate over each student's fees data -->
                @forelse($studentsFeesData as $studentId => $data)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="card-title">{{ $data['student']->first_name }} {{ $data['student']->last_name }}</h2>
                        </div>

                        <!-- Display fees information for each student -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Date</th>
                                        <th>Total Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Remaining Amount</th>
                                        <th>Payment Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data['feesData'] as $fees)
                                        <tr>
                                            <td>{{ date('d-m-Y', strtotime($fees->created_at)) }}</td>
                                            <td>৳{{ number_format($fees->total_amount, 2) }}</td>
                                            <td>
                                                @if($fees->remaining_amount == 0)
                                                    <span class="badge badge-success">Paid</span>
                                                @else
                                                ৳{{ number_format($fees->paid_amount, 2) }}
                                                @endif
                                            </td>
                                            <td>৳{{ number_format($fees->remaining_amount, 2) }}</td>
                                            <td>{{ $fees->payment_type }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No fees records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @empty
                    <p>No students found for this parent.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
