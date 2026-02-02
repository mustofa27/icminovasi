<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleLike;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of published articles
     */
    public function index()
    {
        $articles = Article::published()->recent()->paginate(12);
        return view('articles.index', compact('articles'));
    }

    /**
     * Display the specified article
     */
    public function show(Article $article)
    {
        // Only show published articles to visitors
        if (!$article->isPublished()) {
            abort(404);
        }

        $article->increment('views_count');
        $comments = $article->approvedComments()->latest()->paginate(10);
        $liked = $this->hasLiked($article);

        return view('articles.show', compact('article', 'comments', 'liked'));
    }

    /**
     * Store a new comment on the article
     */
    public function storeComment(Request $request, Article $article)
    {
        if (!$article->isPublished()) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string|min:2|max:1000',
        ]);

        $validated['article_id'] = $article->id;
        $validated['status'] = 'pending';

        Comment::create($validated);
        $article->increment('comments_count');

        return back()->with('success', 'Your comment has been submitted and is awaiting approval');
    }

    /**
     * Like or unlike an article
     */
    public function toggleLike(Request $request, Article $article)
    {
        if (!$article->isPublished()) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        $ipAddress = $request->ip();

        $like = ArticleLike::where('article_id', $article->id)
            ->where('ip_address', $ipAddress)
            ->first();

        if ($like) {
            $like->delete();
            $article->decrement('likes_count');
            $liked = false;
        } else {
            ArticleLike::create([
                'article_id' => $article->id,
                'ip_address' => $ipAddress,
            ]);
            $article->increment('likes_count');
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes_count' => $article->likes_count,
        ]);
    }

    /**
     * Check if current user/IP has liked the article
     */
    private function hasLiked(Article $article): bool
    {
        return ArticleLike::where('article_id', $article->id)
            ->where('ip_address', request()->ip())
            ->exists();
    }
}
