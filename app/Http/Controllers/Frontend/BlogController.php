<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::published()->with(['category', 'tags'])->latest();

        if ($request->search) {
            $query->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('excerpt', 'like', '%'.$request->search.'%');
        }

        $posts = $query->paginate(9);
        $categories = Category::withCount('publishedPosts')->get();
        $tags = Tag::withCount('posts')->orderByDesc('posts_count')->take(20)->get();
        $recentPosts = Post::published()->latest()->take(5)->get();

        return view('frontend.blog.index', compact('posts', 'categories', 'tags', 'recentPosts'));
    }

    public function category(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::published()->where('category_id', $category->id)->with('tags')->latest()->paginate(9);
        $categories = Category::withCount('publishedPosts')->get();
        $tags = Tag::withCount('posts')->take(20)->get();

        return view('frontend.blog.category', compact('posts', 'category', 'categories', 'tags'));
    }

    public function tag(string $slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->published()->with('category')->latest()->paginate(9);
        $categories = Category::withCount('publishedPosts')->get();
        $tags = Tag::withCount('posts')->take(20)->get();

        return view('frontend.blog.tag', compact('posts', 'tag', 'categories', 'tags'));
    }

    public function show(string $slug)
    {
        $post = Post::published()->with(['category', 'tags', 'approvedComments'])->where('slug', $slug)->firstOrFail();
        $post->increment('views');

        $relatedPosts = Post::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->take(3)->get();

        $recentPosts = Post::published()->where('id', '!=', $post->id)->latest()->take(5)->get();
        $categories = Category::withCount('publishedPosts')->get();
        $tags = Tag::withCount('posts')->take(20)->get();

        return view('frontend.blog.show', compact('post', 'relatedPosts', 'recentPosts', 'categories', 'tags'));
    }

    public function comment(Request $request, string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'body' => 'required|string|min:10|max:2000',
        ]);

        Comment::create(array_merge($validated, ['post_id' => $post->id]));

        return back()->with('success', 'Comment submitted and awaiting moderation. Thank you!');
    }
}
