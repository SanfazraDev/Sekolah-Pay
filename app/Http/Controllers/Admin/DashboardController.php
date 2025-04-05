<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $totalTransaction = Transaction::query()->where('status', 'paid')->where('is_approved', true)->count();
        $totalStudent = Student::query()->where('status', 'active')->count();
        $totalClassroom = Classroom::query()->count();

        return Inertia::render('Admin/Dashboard', [
            'totalTransaction' => $totalTransaction,
            'totalStudent' => $totalStudent,
            'totalClassroom' => $totalClassroom
        ]);
        
    }
}
