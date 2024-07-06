<!-- resources/views/salaries/create.blade.php -->
@extends('layouts.app')
<style>
    #employeeSelect option {
        margin: 20px;
        padding: 10px
    }
</style>
@section('content')
    <div class="col-lg-3"></div>
    <div class="col-lg-6 mx-auto mt-4">
        <h1>Add Salary</h1>
        <a href="{{ route('salaries.index') }}"><Button class="btn btn-info">Back to List</Button></a>
        <form id="salary-form" action="{{ route('salaries.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="employeeSelect">Employee</label>
                <select id="employeeSelect" name="employee_id" class="form-control" required>
                    <option value="">Select Employee</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ old('email', $salary->email ?? '') }}" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount" class="form-control" required>
                @error('amount')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="payment_date">Payment Date</label>
                <input type="date" name="payment_date" id="payment_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea name="remarks" id="remarks" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Salary</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
