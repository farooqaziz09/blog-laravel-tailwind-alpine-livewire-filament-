<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $featuredPosts = Cache::remember('featuredPosts', Carbon::now()->addDay(), function () {
            return Post::published()->featured()->with('categories')->latest('published_at')->take(3)->get();
        });

        $latestPosts = Cache::remember('latestPosts', Carbon::now()->addDay(), function () {
            return Post::featured()->take(9)->with('categories')->get();
        });
        return view('home', compact('featuredPosts', 'latestPosts'));
    }
}
