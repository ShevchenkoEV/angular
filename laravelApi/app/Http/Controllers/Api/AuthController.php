<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Response\ResponseService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credential = request(['email', 'password']);


        if (!Auth::attempt($credential)){
            return ResponseService::sendJsonResponse(
                false,
                403,
                ['message' => __('auth.failed')]);
        }

        $user = Auth::user();

        $accessToken = $user->createToken('Personal Access Token');

        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'user' => $user,
                'api_token' => $accessToken->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($accessToken->token->expires_at)->toDateTimeString(),
            ]);
    }

    public function registration(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        Auth::login($user);
        $accessToken = $user->createToken('Personal Access Token');

        return ResponseService::sendJsonResponse(
            true,
            200,
            [],
            [
                'user' => $user,
                'api_token' => $accessToken->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($accessToken->token->expires_at)->toDateTimeString(),
            ]);


    }
}
