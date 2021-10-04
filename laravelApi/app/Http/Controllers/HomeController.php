<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'user'])->orderBy('id', 'desc')->paginate(10);

        return view('front.index', compact('posts'));
    }
}
