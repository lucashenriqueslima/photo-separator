<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout() {

        //auth()->user()->tokens()->delete(); // Revoga todos os tokens do usuário
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Usuário deslogado com sucesso.'
        ]);
    }
}
