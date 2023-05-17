<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function signin(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|confirmed',
    ]);

    $user = new User([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $user->save();


    $tokenResult = $user->createToken('Access Token');

    return response()->json([
        'message' => 'Usuario registrado exitosamente!',
        'access_token' => $tokenResult->plainTextToken,
        'token_type' => 'Bearer',
    ], 201);
}

    

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    $credentials = request(['email', 'password']);

    if (!Auth::attempt($credentials)) {
        return response()->json([
            'message' => 'No se pudo autenticar. Por favor, revisa tus credenciales.'
        ], 401);
    }

    $user = $request->user();
    $token = $user->createToken('Access Token');

    return response()->json([
        'access_token' => $token->plainTextToken,
        'token_type' => 'Bearer',
    ]);
}


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Sesión cerrada exitosamente'
        ]);
    }
}
