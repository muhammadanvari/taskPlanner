<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comments;
use App\Models\Projects;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $comments = Comments::where('approved',0)->count();
        $tickets = Ticket::where('parent_id',null)->where('status', 'open')->count();
        $blogs = Blog::latest()->take(5)->get();
        return view('admin.index',compact('comments','tickets','users','blogs'));
    }
}
