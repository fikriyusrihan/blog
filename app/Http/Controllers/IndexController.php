<?php

namespace App\Http\Controllers;

use App\Models\General;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        // get the general information about the website
        $website = General::query()->firstOrFail();

        // get the post that are published
        $posts = Post::query()
            ->where('is_published', true)
            ->orderBy('id', 'desc')
            ->paginate(5);

        // get all featured post
        $featured_posts = Post::query()
            ->where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        // get all categories
        $categories = Category::all();

        // get all tags
        $tags = Tag::all();

        // get the recent 5 posts
        $recent_posts = Post::query()
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('home', [
            'website' => $website,
            'posts' => $posts,
            'featured_posts' => $featured_posts,
            'categories' => $categories,
            'tags' => $tags,
            'recent_posts' => $recent_posts
        ]);
    }


}
