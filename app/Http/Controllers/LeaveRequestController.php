<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveRequest;
use Carbon\Carbon;

class LeaveRequestController extends Controller
{
    // For users
    public function userIndex()
    {
        $user = auth()->user();
        $leaveRequests = LeaveRequest::where('user_id', auth()->user()->id)->get();
        return view('leaves.user', compact('leaveRequests', 'user'));
    }

    public function userCreate()
    {
        return view('leaves.create');
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'remark' => 'nullable|string',
        ]);

        // Check if the user already has a leave request for the same day
        $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
        $endDate = Carbon::parse($request->end_date)->format('Y-m-d');

        $existingLeave = LeaveRequest::where('user_id', auth()->user()->id)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereDate('start_date', $startDate)
                    ->orWhereDate('end_date', $endDate);
            })
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($existingLeave) {
            return redirect()->route('user.leaves.index')->with('error', 'You already have a leave request for the selected dates.');
        }

        LeaveRequest::create([
            'user_id' => auth()->user()->id,
            'type' => $request->type,
            'remark' => $request->remark,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending',
        ]);

        return redirect()->route('user.leaves.index')->with('success', 'Leave request submitted successfully.');
    }

    // For admins
    public function adminIndex()
    {
        $leaveRequests = LeaveRequest::with('user')->get();
        return view('leaves.admin', compact('leaveRequests'));
    }

    public function adminUpdate(Request $request, LeaveRequest $leaveRequest)
    {
        $request->validate([
            'status' => 'required|string|in:approved,rejected,pending',
        ]);

        $leaveRequest->update(['status' => $request->status]);

        return redirect()->route('admin.leaves.index')->with('success', 'Leave request status updated.');
    }
}
