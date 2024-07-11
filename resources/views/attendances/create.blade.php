@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-lg-3"></div>
            <div class="col-md-6">
                <!-- Card Layout for the Form -->
                <div class="card">
                    <div class="card-header">
                        <h1>Record Attendance for {{ $user->name }}</h1>
                        <a href="{{ route('users.attendances', ['user' => $user->id]) }}" class="btn btn-info">Back to
                            List</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('attendances.store', $user->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="attendance_date">Date</label>
                                <input type="text"  name="attendance_date" id="attendance_date"
                                    class="form-control datetimepicker" required>
                                <button type="button" class="btn btn-secondary mt-2" onclick="setCurrentDate()">Set Current
                                    Date</button>
                            </div>
                            <div class="form-group">
                                <label for="clock_in">Clock In</label>
                                <input type="text"  name="clock_in" id="clock_in"
                                    class="form-control datetimepicker">
                                <button type="button" class="btn btn-secondary mt-2" onclick="setClockIn()">Set Current
                                    Time</button>
                            </div>
                            <div class="form-group">
                                <label for="clock_out">Clock Out</label>
                                <input type="text"  name="clock_out" id="clock_out"
                                    class="form-control datetimepicker">
                                <button type="button" class="btn btn-secondary mt-2" onclick="setClockOut()">Set Current
                                    Time</button>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Flatpickr CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        // Initialize Flatpickr for date and time fields
        flatpickr("#attendance_date", {
            dateFormat: "Y-m-d"
        });

        flatpickr("#clock_in", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i"
        });

        flatpickr("#clock_out", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i"
        });

        function setCurrentDate() {
            let now = new Date();
            let todayDate = now.toISOString().split('T')[0];
            document.getElementById('attendance_date').value = todayDate;
        }

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
    </script>
@endsection
