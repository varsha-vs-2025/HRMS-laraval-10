<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLeave;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource (View Leave Requests).
     */
    public function index()
{
    $user = auth()->user(); // Get the logged-in user
    
    if ($user->role_id == 1) {
        // ✅ Admin sees all leave requests with employee details
        $leaves = EmployeeLeave::with('employee.user')->get();
    } else {
        // ✅ User sees only their own leave requests
        $leaves = EmployeeLeave::where('employee_id', $user->id)->get();
    }

    return view('leave.index', compact('leaves'));
}

    /**
     * Show the form for creating a new leave request.
     */
    public function create()
    {
        return view('leave.create');
    }

    /**
     * Store a newly created leave request.
     */
    public function store(Request $request)
    {
        $userId = auth()->user()->id; // Get logged-in user ID

        $validatedData = $request->validate([
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        EmployeeLeave::create([
            'employee_id' => $userId,
            'leave_type' => $validatedData['leave_type'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'reason' => $validatedData['reason'],
            'status' => 'Pending', // Default status
        ]);

        return redirect()->route('employee-leaves.index')->with('success', 'Leave request submitted successfully.');
    }

    /**
     * Display only the logged-in user's leave requests.
     */
    public function myLeaves()
    {
        $userId = auth()->id(); // Get logged-in user's ID
        $leaves = EmployeeLeave::where('employee_id', $userId)
                               ->orderBy('created_at', 'desc')
                               ->get(); 
        return view('leave.index', compact('leaves'));
    }

    /**
     * Approve a leave request.
     */
    public function approve($id)
    {
        $leave = EmployeeLeave::findOrFail($id);
        $leave->status = 'Approved'; 
        $leave->save();

        return redirect()->back()->with('success', 'Leave request approved successfully!');
    }

    /**
     * Reject a leave request.
     */
    public function reject($id)
    {
        $leave = EmployeeLeave::findOrFail($id);
        $leave->status = 'Rejected'; 
        $leave->save();

        return redirect()->back()->with('error', 'Leave request rejected.');
    }

    // Keeping existing methods unchanged
    public function show(EmployeeLeave $employeeLeave)
    {
        //
    }

    public function edit(EmployeeLeave $employeeLeave)
    {
        //
    }

    public function update(Request $request, EmployeeLeave $employeeLeave)
    {
        //
    }

    public function destroy(EmployeeLeave $employeeLeave)
    {
        //
    }
}
