@extends('backend.layouts.app')

@section('content')
<div class="wrapper">
    <div class="content-wrapper">
        <h1>Fees Collection</h1>

        <!-- Display success message if any -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Display student information -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Class Name</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Remaining Amount</th>
                    <th>Last Payment Type</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td>{{ $student->class->class_name ?? 'N/A' }}</td>
                        <td>৳{{ isset($student->class->amount) ? number_format($student->class->amount, 2) : 'N/A' }}</td>
                        <td>
                            @php
                                $paidAmount = $student->feesCollection->sum('paid_amount');
                            @endphp
                            @if(isset($student->class->amount))
                                @if($paidAmount >= $student->class->amount)
                                    Paid
                                @else
                                ৳{{ number_format($paidAmount, 2) }}
                                @endif
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if(isset($student->class->amount))
                                @php
                                    $remainingAmount = $student->class->amount - $paidAmount;
                                @endphp
                                @if($remainingAmount > 0)
                                ৳{{ number_format($remainingAmount, 2) }}
                                @else
                                    Paid
                                @endif
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $student->feesCollection->last()->payment_type ?? 'N/A' }}</td>
                        <td>{{ date('d-m-Y', strtotime($student->created_at)) }}</td>
                        <td>
                            @if(isset($student->class->amount))
                                @if($remainingAmount > 0)
                                    <a href="{{ route('admin.fees_collection_add', ['student_id' => $student->id, 'class_id' => $student->class->id]) }}" class="btn btn-danger">Collect Fees</a>
                                @else
                                    <button class="btn btn-success" disabled>Collected</button>
                                @endif
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
