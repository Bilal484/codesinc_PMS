@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <h3>Request Leave</h3>
            <a href="{{ route('user.leaves.index') }}" class="btn btn-info">Back to List</a>
            <form action="{{ route('user.leaves.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="type">Leave Type</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="sick">Sick Leave</option>
                        <option value="casual">Casual Leave</option>
                        <option value="paid">Paid Leave</option>
                        <option value="unpaid">Unpaid Leave</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="remark">Remark</label>
                    <input type="text" name="remark" id="remark" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="start_date">Form</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="end_date">To</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit Request</button>
            </form>
        </div>
    </div>
@endsection
