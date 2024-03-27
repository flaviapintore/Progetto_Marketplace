<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('Announcement.create');
    }

    public function showAnnouncement(Announcement $announcement)
    {
        return view('Announcement.show' , compact('announcement'));
    }

    public function indexAnnouncement(Announcement $announcement)
    {
        $announcements = Announcement::where('is_accepted' , true)->orderBy('created_at' , 'desc')->paginate(6);
        return view('Announcement.index' , compact('announcements'));
    }
}
