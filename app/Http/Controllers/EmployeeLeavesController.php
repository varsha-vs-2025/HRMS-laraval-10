<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeLeavesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource (View Leave Requests).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /* $leaves = EmployeeLeave::where('employee_id', Auth::id())->get();
        return view('leave.index', compact('leaves')); */
       /* $leaves = EmployeeLeave::orderBy('created_at', 'desc')->get(); // Fetch all leaves in latest order
    return view('admin.leave_management.index', compact('leaves'));*/
    /*$leaves = EmployeeLeave::all();
    return view('leave.index', compact('leaves')); // ✅ Change to the correct <path></path>*/

    /*$user = auth()->user(); // Get the logged-in user

    if ($user->role_id == 1) {
        // Admin: See all leave applications
        $leaves = EmployeeLeave::all();
    } else {
        // Regular user: See only their own leave applications
        $leaves = EmployeeLeave::where('employee_id', $user->id)->get();
    }

    return view('leave.index', compact('leaves'));*/

    $user = auth()->user(); // Get the logged-in user
    
    if (auth()->user()->role_id == 1) {
        // ✅ Admin sees all leave requests
        $leaves = EmployeeLeave::with('user')->get();
    } else {
        // ✅ User sees only their own leave requests
        $leaves = EmployeeLeave::where('employee_id', auth()->user()->id)->get();
    }

return view('employee-leaves.index', compact('leaves'));

    }

    /**
     * Show the form for creating a new leave request.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leave.create');
    }

    /**
     * Store a newly created leave request in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
public function myLeaves()
{
    $userId = auth()->id(); // Get logged-in user's ID
    $leaves = EmployeeLeave::where('employee_id', $userId)
                           ->orderBy('created_at', 'desc')
                           ->get(); // Fetch only logged-in user's leaves
    return view('leave.index', compact('leaves')); // Ensure correct view file
}

public function approve($id)
{
    $leave = EmployeeLeave::findOrFail($id);
    $leave->status = 'Approved'; // ✅ Update status to Approved
    $leave->save();

    return redirect()->back()->with('success', 'Leave request approved successfully!');
}

public function reject($id)
{
    $leave = EmployeeLeave::findOrFail($id);
    $leave->status = 'Rejected'; // ✅ Update status to Rejected
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
