@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $user->name }}'s Attendances</h1>
        <a href="{{ route('users.attendances.create', $user->id) }}" class="btn btn-primary mb-3">Add Attendance</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Clock In</th>
                    <th>Clock Out</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->id }}</td>
                        <td>{{ $attendance->attendance_date }}</td>
                        <td>{{ $attendance->clock_in }}</td>
                        <td>{{ $attendance->clock_out }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
