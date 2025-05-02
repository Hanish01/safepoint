<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class IncidentController extends Controller
{
    public function showForm()
    {
        return view('incident_reporting');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        Complaint::create([
            'user_id' => Auth::id(),
            'description' => $request->description,
            'status' => 'unresolved',
        ]);

        return redirect()->route('incident.reports')->with('success', 'Incident reported successfully.');
    }

    public function showReports()
    {
        $complaints = Complaint::where('user_id', Auth::id())->get();

        return view('showing_reporting', compact('complaints'));
    }
}
