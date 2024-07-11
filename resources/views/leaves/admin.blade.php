@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h3>All Leave Requests</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Type</th>
                <th>Remark</th>
                <th>Form</th>
                <th>To</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaveRequests as $request)
                <tr>
                    <td><b>{{ $request->user->name }}</b></td>
                    <td>{{ $request->type }}</td>
                    <td>{{ $request->remark }}</td>
                    <td>{{ $request->start_date }}</td>
                    <td>{{ $request->end_date }}</td>
                    <td>{{ $request->status }}</td>
                    <td>
                        @if ($request->status === 'pending')
                            <!-- Approve Button -->
                            <form action="{{ route('admin.leaves.update', $request) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>

                            <!-- Reject Button -->
                            <form action="{{ route('admin.leaves.update', $request) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                        @else
                            <!-- Display a message if the request is not pending -->
                            <span class="text-muted">Already {{ ucfirst($request->status) }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
