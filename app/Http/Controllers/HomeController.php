<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $featuredPosts = Post::published()->featured()->latest('published_at')->take(3)->get();
        $latestPosts = Post::featured()->take(9)->get();
        return view('home', compact('featuredPosts', 'latestPosts'));
    }
}
