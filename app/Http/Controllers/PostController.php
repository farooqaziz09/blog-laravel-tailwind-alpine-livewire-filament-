<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::wherehas('posts', function ($query) {
            $query->published();
        })->take(5)->get();
        return view('posts.index', compact('categories'));
    }
    public function show(Post $post)
    {        
        return view('posts.show', compact('post'));
    }
}
