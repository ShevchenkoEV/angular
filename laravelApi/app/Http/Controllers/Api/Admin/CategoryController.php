<?php

namespace App\Http\Controllers\Api\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Services\Response\ResponseService;
use http\Message;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
                'items' => Category::with(['posts'])->orderBy('id', 'desc')->get()
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
        ]);


        $category = Category::create($request->all());

        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'items' => $category
//                'items' => Category::with(['posts'])->orderBy('id', 'desc')->get()
//            'items' => PostResource::collection(Post::with(['category', 'user'])->get())
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
        $category = Category::find($id);

        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'item' => $category
//                'items' => Category::with(['posts'])->orderBy('id', 'desc')->get()
//            'items' => PostResource::collection(Post::with(['category', 'user'])->get())
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
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $category = Category::find($request->id);
        $category->slug = null;
        $category->update($request->all());

        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'item' => $category,
//                'request' => $data,
//                'items' => Category::with(['posts'])->orderBy('id', 'desc')->get()
//            'items' => PostResource::collection(Post::with(['category', 'user'])->get())
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
        $category = Category::find($id);
        if ($category->posts->count()) {
            return ResponseService::sendJsonResponse(false, 409, [], [
                'messege' => '!!! Невозможно удалить, категория связана с постом !!!'
            ]);

        }
        $category->delete();
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'message' => 'Категория удалена',
//                'request' => $data,
//                'items' => Category::with(['posts'])->orderBy('id', 'desc')->get()
//            'items' => PostResource::collection(Post::with(['category', 'user'])->get())
            ]
        );
    }
}
