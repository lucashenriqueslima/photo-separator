<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {

        if(!auth()->attempt($request->validated())) {

            return response()->json([
                'message' => 'Email ou senha inválido(s).'
            ], 401);

        }

        $token = auth()->user()->createToken('user_token');

        return response()->json([
            'data' => [
                'user' => auth()->user(),
                'token' => $token->plainTextToken
            ]
        ]);
    }
}
