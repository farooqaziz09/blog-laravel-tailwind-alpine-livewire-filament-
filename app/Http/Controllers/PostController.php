<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index()
    {
        $categories = Cache::remember('categories', Carbon::now()->addDay(3), function () {
            return Category::wherehas('posts', function ($query) {
                $query->published();
            })->take(5)->get();
        });
        return view('posts.index', compact('categories'));
    }
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
