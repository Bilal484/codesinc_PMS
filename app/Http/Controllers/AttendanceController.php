<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendance;
use App\Leave;
use App\LeaveRequest;
use App\Entities\Users\User;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index($userId)
    {
        // Fetch the user
        $user = User::findOrFail($userId);

        // Fetch attendance records for the user
        $attendances = Attendance::where('user_id', $userId)->get();

        // Fetch leave requests for the user
        $leaves = LeaveRequest::where('user_id', $userId)->get();

        // Determine if the user has a leave today
        $today = now()->format('Y-m-d');
        $hasLeaveToday = $leaves->contains(function ($leave) use ($today) {
            return $today >= $leave->start_date && $today <= $leave->end_date;
        });

        // Pass data to the view
        return view('attendances.index', compact('user', 'attendances', 'leaves', 'hasLeaveToday'));
    }


    public function create(User $user)
    {
        return view('attendances.create', compact('user'));
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'attendance_date' => 'required|date',
            'clock_in' => 'nullable|date_format:H:i',
            'clock_out' => 'nullable|date_format:H:i',
        ]);

        $attendanceDate = $request->attendance_date;

        // Check if an attendance record already exists for this date
        $attendance = Attendance::where('user_id', $user->id)
            ->where('attendance_date', $attendanceDate)
            ->first();

        if ($attendance) {
            // Update the existing record
            $attendance->update([
                'clock_in' => $request->clock_in ?? $attendance->clock_in,
                'clock_out' => $request->clock_out ?? $attendance->clock_out,
            ]);
        } else {
            // Create a new record
            Attendance::create([
                'user_id' => $user->id,
                'attendance_date' => $attendanceDate,
                'clock_in' => $request->clock_in,
                'clock_out' => $request->clock_out,
            ]);
        }

        return redirect()->route('users.attendances', $user->id)->with('success', 'Attendance updated successfully.');
    }

    private function checkAndStoreLeaves(User $user)
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $attendanceDates = Attendance::where('user_id', $user->id)
            ->whereBetween('attendance_date', [$startDate, $endDate])
            ->pluck('attendance_date')
            ->toArray();

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            if (!in_array($date->toDateString(), $attendanceDates) && !$date->isWeekend()) {
                Leave::updateOrCreate(
                    ['user_id' => $user->id, 'leave_date' => $date->toDateString()],
                    ['start_date' => $date->toDateString(), 'end_date' => $date->toDateString()]
                );
            }
        }
    }


    public function getRecord()
    {
        $attendances = Attendance::with('user')->get();
        $leaves = LeaveRequest::with('user')->get();

        return view('attendances.admin_record', compact('attendances', 'leaves'));
    }
}
