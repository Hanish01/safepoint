<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        $totalComplaints = Complaint::count();
        $resolvedComplaints = Complaint::where('status', 'resolved')->count();
        $unresolvedComplaints = Complaint::where('status', 'unresolved')->count();

        return view('dashboard', compact('totalComplaints', 'resolvedComplaints', 'unresolvedComplaints'));
    }
}
