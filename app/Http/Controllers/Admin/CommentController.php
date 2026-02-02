<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of comments
     */
    public function index()
    {
        $comments = Comment::with('article')->latest()->paginate(15);
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for editing the comment
     */
    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', compact('comment'));
    }

    /**
     * Update the specified comment
     */
    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'content' => 'required|string|min:1',
        ]);

        if ($validated['status'] === 'approved') {
            $comment->approve();
        } elseif ($validated['status'] === 'rejected') {
            $comment->reject();
        }

        $comment->update($validated);

        return redirect()->route('admin.comments.index')->with('success', 'Comment updated successfully');
    }

    /**
     * Delete the specified comment
     */
    public function destroy(Comment $comment)
    {
        $article = $comment->article;
        $comment->delete();
        $article->decrement('comments_count');

        return redirect()->route('admin.comments.index')->with('success', 'Comment deleted successfully');
    }
}
