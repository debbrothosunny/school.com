@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <h1>Add Fees Collection</h1>

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
                    <th>Payment Type</th>
                    <th>Created Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $class->class_name }}</td>
                    <td>${{ number_format($class->amount, 2) }}</td>
                    <td>${{ number_format($paidAmount, 2) }}</td>
                    <td>${{ number_format($remainingAmount, 2) }}</td>
                    <td>{{ $feesCollection->payment_type ?? 'N/A' }}</td>
                    <td>{{ date('d-m-Y', strtotime($student->created_at)) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Display error messages if any -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form for collecting fees -->
        <form method="POST" action="{{ route('admin.fees_collection.store') }}">
            @csrf
            <input type="hidden" name="student_id" value="{{ $student->id }}">
            <input type="hidden" name="class_id" value="{{ $class->id }}">
            
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" id="amount" class="form-control" required value="{{ old('amount') }}">
            </div>
            @error('amount')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            
            <div class="form-group">
                <label for="payment_type">Payment Type:</label>
                <input type="text" name="payment_type" id="payment_type" class="form-control" required value="{{ old('payment_type') }}">
            </div>
            @error('payment_type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            
            <button type="submit" class="btn btn-success">Collect</button>
            <a href="{{ route('admin.fees_collection') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
