<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comments::latest()->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    public function update(Comments $comment)
    {
        $comment->update([
            'approved' => 1
        ]);
        return redirect()->back();
    }

    public function destroy(Comments $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index');
    }
}
