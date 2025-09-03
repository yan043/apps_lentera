<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TechnicianAttendanceModel;

class TechnicianAttendanceController extends Controller
{
    public function dailyAttendance()
    {
        return view('technician-attendance.daily-attendance');
    }

    public function shiftManagement()
    {
        return view('technician-attendance.shift-management');
    }

    public function leaveRequest()
    {
        return view('technician-attendance.leave-request');
    }

    public function attendanceReport()
    {
        return view('technician-attendance.attendance-report');
    }

    public function lateAbsenceLogs()
    {
        return view('technician-attendance.late-absence-logs');
    }
}
