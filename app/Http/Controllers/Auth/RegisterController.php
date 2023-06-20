<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request, User $user) {
        
        if(!$user = $user->create($request->validated())) {

            return response()->json([
                'message' => 'Não foi possível criar o usuário.'
            ], 500);

        }

        $token = $user->createToken('user_token');

        return response()->json([
            'data' => [
                'user' => $user, 
                'token' => $token->plainTextToken
            ]
        ]);
    }
}
