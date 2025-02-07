<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            if ($request->expectsJson()) {
                $token = $request->user()->createToken('api-token')->plainTextToken;
                return response()->json([
                    'token' => $token
                ]);
            }

            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return response()->json([
            'error' => 'As credenciais fornecidas não correspondem aos nossos registros.'
        ], 401);
    }

    public function logout(Request $request)
    {
        if ($request->expectsJson()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logout realizado com sucesso']);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout realizado com sucesso');
    }
}