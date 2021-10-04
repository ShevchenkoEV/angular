<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Menu;
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
        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = $request->validate([
           'title' => 'required|string',
           'path' => 'required|string',
           'path_api' => 'required|string',
           'type' => 'required|string',
           'sort_order' => 'required|integer',
        ]);

        Menu::create($menu);
        return redirect()->route('menus.index')->with('success', 'Меню успешно создана!!!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::find($id);
        return view('admin.menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'path' => 'required|string',
            'path_api' => 'required|string',
            'type' => 'required|string',
            'sort_order' => 'required|integer',
        ]);

        $menu = Menu::find($id);
        $menu->update($request->all());
        return redirect()->route('menus.index')->with('success', 'Обновление меню прошло успешно!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);

        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Меню удаена!!!');
    }
}
