<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Post;
use App\Services\Response\ResponseService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function getAllPosts()
    {
//        $posts = Post::all();
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'items' => Post::with(['category', 'user'])->orderBy('id', 'desc')->get()
//            'items' => PostResource::collection(Post::with(['category', 'user'])->get())
            ]
        );
    }
}
