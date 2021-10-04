<?php

namespace App\Http\Controllers\Api\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Services\Response\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',

        ]);

        $data = $request->all();
        $data['image'] = Post::uploadImageAPI($request);
        $data['user_id'] = Auth::user()->id;
        Post::create($data);

        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
//                'request' => $user,
                'items' => $data,
                'message' => 'ok',
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'item' => $post
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $post = Post::find($id);
        $data = $request->all();
        $post['slug'] = null;

        if ( $post['image'] != $request->image) {
            if ($nameImage = Post::uploadImageAPI($request, $post->image)) {
                $data['image'] = $nameImage;
            }
        }
        $post->update($data);
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'request' => [
                   'file' => $post->image,
                    'post' => $post['image'] != $request->image,
                ],
                'item' => $post,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        Storage::delete($post->image);
        $post->delete();
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'message' => 'user удален',
//                'request' => $data,
//                'items' => Category::with(['posts'])->orderBy('id', 'desc')->get()
//            'items' => PostResource::collection(Post::with(['category', 'user'])->get())
            ]
        );
    }
}
