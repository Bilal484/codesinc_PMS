@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Attendance for {{ $user->name }}</h1>
        <form action="{{ route('users.attendances.store', $user->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="attendance_date">Date</label>
                <input type="date" name="attendance_date" id="attendance_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="clock_in">Clock In</label>
                <input type="time" name="clock_in" id="clock_in" class="form-control">
                <button type="button" class="btn btn-secondary mt-2" onclick="setClockIn()">Set Current Time</button>
            </div>
            <div class="form-group">
                <label for="clock_out">Clock Out</label>
                <input type="time" name="clock_out" id="clock_out" class="form-control">
                <button type="button" class="btn btn-secondary mt-2" onclick="setClockOut()">Set Current Time</button>
            </div>
            <button type="submit" class="btn btn-primary">Add Attendance</button>
        </form>
    </div>

    <script>
        function setClockIn() {
            let now = new Date();
            let hours = now.getHours().toString().padStart(2, '0');
            let minutes = now.getMinutes().toString().padStart(2, '0');
            document.getElementById('clock_in').value = `${hours}:${minutes}`;
        }

        function setClockOut() {
            let now = new Date();
            let hours = now.getHours().toString().padStart(2, '0');
            let minutes = now.getMinutes().toString().padStart(2, '0');
            document.getElementById('clock_out').value = `${hours}:${minutes}`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            let now = new Date().toISOString().split('T')[0];
            document.getElementById('attendance_date').value = now;
        });
    </script>
@endsection
