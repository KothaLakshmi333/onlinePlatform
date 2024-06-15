<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function admin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Logic for admin
        return view('admin.dashboard');
    }

    public function instructor()
    {
        if (Auth::user()->role !== 'instructor') {
            abort(403, 'Unauthorized action.');
        }

        // Logic for instructor
        return view('instructor.dashboard');
    }

    public function student()
    {
        if (Auth::user()->role !== 'student') {
            abort(403, 'Unauthorized action.');
        }

        // Logic for student
        return view('student.dashboard');
    }
}
