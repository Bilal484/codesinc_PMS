@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success mt-4">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-4">{{ session('error') }}</div>
    @endif
    <h3>Your Leave Requests</h3>
    <a href="{{ route('user.leaves.create') }}" class="btn btn-primary">Request for Leave</a>
    <a href="{{ route('users.attendances', ['user' => $user->id]) }}" class="btn btn-info">Back to
        List</a>
    <table class="table">
        <thead>
            <tr>
                <th>Type</th>
                <th>Remark</th>
                <th>From</th>
                <th>To</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaveRequests as $request)
                <tr>
                    <td>{{ $request->type }}</td>
                    <td>{{ $request->remark }}</td>
                    <td>{{ $request->start_date }}</td>
                    <td>{{ $request->end_date }}</td>
                    <td>{{ $request->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
