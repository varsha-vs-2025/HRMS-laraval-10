<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Recruitment;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() 
    {
        // Fetch latest 5 announcements
        $announcements = Announcement::latest()->take(5)->get();

        // Fetch latest 5 active recruitments
        $recruitments = Recruitment::where('is_active', 1)->latest()->take(5)->get();

        // Return the correct view: 'pages.welcome' instead of 'home'
        return view('pages.welcome', compact('announcements', 'recruitments'));
    }

    public function announcements() 
    {
        $announcements = Announcement::where('department_id', null)->latest()->paginate(10);
        return view('pages.welcome_announcements', compact('announcements'));
    }

    public function announcementShow(Announcement $announcement) 
    {
        return view('pages.welcome_announcements_show', compact('announcement'));
    }

    public function recruitments() 
    {
        $recruitments = Recruitment::where('is_active', 1)->latest()->paginate(10);
        return view('pages.welcome_recruitments', compact('recruitments'));
    }

    public function recruitmentShow(Recruitment $recruitment) 
    {
        return view('pages.welcome_recruitments_show', compact('recruitment'));
    }
}
