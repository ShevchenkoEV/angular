<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\Response\ResponseService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class UserController extends Controller
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
                'items' => User::all()
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',

        ]);
        $user = $request->all();

        $user['avatar'] = User::uploadImageAPI($request);
        $user['password'] = User::getPassword($request['password']);
        User::create($user);

        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
//                'request' => $user,
                'items' => $user,
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
        $user = User::find($id);

        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'item' => $user
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
        $user = User::find($request->id);

        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);
        $data = $request->all();
        if ($user['avatar'] != $request->avatar) {
            if ($file = User::uploadImageAPI($request, $user->avatar)) {
                $data['avatar'] = $file;
            }
        }

        $data['password'] = User::getPassword($data['password'], $user);
//
        $user->update($data);

        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'request' => $user->avatar,
                'item' => $user,
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
        $user = User::find($id);
        $user->delete();
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
