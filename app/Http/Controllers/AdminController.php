<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComplaintResolved;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $username = $request->input('username');

        if ($username === 'admin') {
            $request->session()->put('is_admin', true);
            return redirect()->route('admin.panel');
        }

        return back()->withErrors([
            'login_error' => 'Invalid admin username.',
        ]);
    }

    public function showAdminPanel(Request $request)
    {
        if (!$request->session()->get('is_admin')) {
            return redirect()->route('admin.login.form');
        }

        $complaints = Complaint::with('user')->get();

        return view('admin_panel', ['complaints' => $complaints]);
    }

    public function deleteComplaint(Request $request, $id)
    {
        if (!$request->session()->get('is_admin')) {
            return redirect()->route('admin.login.form');
        }

        $complaint = Complaint::findOrFail($id);
        $complaint->delete();

        return redirect()->route('admin.panel')->with('success', 'Complaint deleted successfully.');
    }

    public function resolveComplaint(Request $request)
    {
        if (!$request->session()->get('is_admin')) {
            return redirect()->route('admin.login.form');
        }

        $request->validate([
            'complaint_id' => 'required|integer|exists:complaints,id',
            'admin_comment' => 'required|string',
        ]);

        $complaint = Complaint::findOrFail($request->input('complaint_id'));
        $complaint->status = 'resolved';
        $complaint->admin_comment = $request->input('admin_comment');
        $complaint->save();

        // Send email to user
        if ($complaint->user && $complaint->user->email) {
            Mail::to($complaint->user->email)->send(new ComplaintResolved($complaint));
        }

        return redirect()->route('admin.panel')->with('success', 'Complaint resolved and user notified.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');
        return redirect()->route('admin.login.form');
    }
}
