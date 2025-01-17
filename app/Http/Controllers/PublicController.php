<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home () {
        $announcements = Announcement::where('is_accepted', true)->orderByDesc('created_at')->take(6)->get();
        return view('welcome', compact('announcements'));
    }
    public function categoryShow(Category $category){
        return view('categoryShow', compact('category'));
}
    public function searchAnnouncements(Request $request){
        $announcements = Announcement::search($request->searched)->where('is_accepted' ,true)->paginate(10);
        return view('announcement.index' , compact('announcements'));
    }

    public function setLanguage($lang){
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
