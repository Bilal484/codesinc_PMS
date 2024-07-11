@extends('layouts.app')

@section('content')
    <div class="row mt-4">

        <!-- Attendance Records Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="mb-0">Attendance Records</h3>
            </div>
            <div class="card-body">
                @if ($attendances->isEmpty())
                    <p>No attendance records found.</p>
                @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Date</th>
                                <th>Clock In</th>
                                <th>Clock Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->user->name }}</td>
                                    <td>{{ $attendance->attendance_date }}</td>
                                    <td>{{ $attendance->clock_in }}</td>
                                    <td>{{ $attendance->clock_out }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>

        <!-- Leave Requests Section -->
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Leave Requests</h3>
            </div>
            <div class="card-body">
                @if ($leaves->isEmpty())
                    <p>No leave requests found.</p>
                @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaves as $leave)
                                <tr>
                                    <td>{{ $leave->user->name }}</td>
                                    <td>{{ $leave->type }}</td>
                                    <td>{{ $leave->start_date }}</td>
                                    <td>{{ $leave->end_date }}</td>
                                    <td>
                                        @if ($leave->status === 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif ($leave->status === 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
