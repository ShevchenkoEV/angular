<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Menu;
use App\Services\Response\ResponseService;
use Illuminate\Http\Request;

class MenuController extends Controller
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
                'items' => Menu::all()
            ]
        );
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'path' => 'required',
            'path_api' => 'required',
            'type' => 'required',
            'sort_order' => 'required',
        ]);

        $menu = Menu::create($request->all());

        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'items' => $menu
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::find($id);

        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'item' => $menu
            ]
        );
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'path' => 'required',
            'path_api' => 'required',
            'type' => 'required',
            'sort_order' => 'required',
        ]);

        $menu = Menu::find($request->id);
        $menu->update($request->all());

        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'item' => $menu,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Menu::find($id);
        $category->delete();
        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'message' => 'Меню удалено',
            ]
        );
    }
}
