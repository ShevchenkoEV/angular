<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Menu;
use App\Services\Response\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function getMenu(Request $request)
    {
            return ResponseService::sendJsonResponse(
                true,
                200,
                [],
                [
                    'items' => (Menu::where('type', 'admin')->orderBy('sort_order')->get())->toArray()
                ]
            );
    }

}
