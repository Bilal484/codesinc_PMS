@extends('layouts.app')

<style>
    .disabled-link {
        pointer-events: none;
        cursor: not-allowed;
        opacity: 0.6;
    }
</style>

@section('content')
    <div class=" mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <h3 class="mb-4">Attendance for {{ $user->name }}</h3>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <a href="{{ route('attendances.create', $user->id) }}"
                    class="btn btn-primary me-2 {{ $hasLeaveToday ? 'disabled-link' : '' }}">
                    Add Attendance
                </a>
                <a href="{{ route('user.leaves.index') }}" class="btn btn-success">Leave Request</a>
            </div>
        </div>

        <!-- Attendance Records Section -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card">
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
                                        <th>Date</th>
                                        <th>Clock In</th>
                                        <th>Clock Out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $attendance)
                                        <tr>
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
            </div>
        </div>

        <!-- Leave Requests Section -->
        <div class="row">
            <div class="col-lg-12">
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
                                        <th>Type</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaves as $leave)
                                        <tr>
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
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var hasLeaveToday = @json($hasLeaveToday);
            var addAttendanceButton = document.querySelector('.btn-primary');

            if (hasLeaveToday) {
                addAttendanceButton.classList.add('disabled-link');
                addAttendanceButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    alert('You cannot add attendance today due to an existing leave request.');
                });
            }
        });
    </script>
@endsection
