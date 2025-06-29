<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnnouncementRequest;
use App\Models\Announcement;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AnnouncementsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $announcements = Announcement::latest()->paginate(10);
        $accesses = auth()->user()->role->accesses ?? collect(); // ✅ Pass accesses

        return view('pages.announcements', compact('announcements', 'accesses')); // ✅ Include accesses
    }

    public function create()
    {
        if (auth()->user()->role_id != 1) {
            return redirect()->route('announcements.index')->with('error', 'Unauthorized');
        }

        $departments = Department::all();
        $accesses = auth()->user()->role->accesses;

        return view('pages.announcements_create', compact('departments', 'accesses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'department_id' => 'nullable|exists:departments,id',
            'attachment' => 'nullable|file|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'department_id' => $request->department_id,
            'created_by' => auth()->user()->id,
        ];

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        Announcement::create($data);

        return redirect()->route('announcements.index')->with('success', 'Announcement created.');
    }

    public function show(Announcement $announcement)
    {
        return view('pages.announcements_show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        if (auth()->user()->role_id != 1) {
            return redirect()->route('announcements.index')->with('error', 'Unauthorized');
        }

        $departments = Department::all();
        return view('pages.announcements_edit', compact('announcement', 'departments'));
    }

    public function update(StoreAnnouncementRequest $request, Announcement $announcement)
    {
        $data = $request->validated();

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $announcement->update($data);

        return redirect()->route('announcements.index')->with('status', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement)
    {
        if (auth()->user()->role_id !== 1) {
            return redirect()->route('announcements.index')->with('error', 'Unauthorized action.');
        }

        $announcement->delete();

        return redirect()->route('announcements.index')->with('status', 'Announcement deleted.');
    }
}
