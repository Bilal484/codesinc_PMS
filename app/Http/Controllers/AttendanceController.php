<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attendance;
use App\Entities\Users\User;

class AttendanceController extends Controller
{
    public function index(User $user)
    {
        $attendances = Attendance::where('user_id', $user->id)->get();
        return view('attendances.index', compact('attendances', 'user'));
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

        Attendance::create([
            'user_id' => $user->id,
            'attendance_date' => $request->attendance_date,
            'clock_in' => $request->clock_in,
            'clock_out' => $request->clock_out,
        ]);

        return redirect()->route('users.attendances', $user->id)->with('success', 'Attendance recorded successfully.');
    }
}
