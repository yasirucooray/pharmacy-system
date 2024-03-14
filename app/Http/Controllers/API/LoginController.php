<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }

        $user = Auth::user();

        return response()->json(['user' => $user, 'token' => $user->createToken('Pharmacy')->plainTextToken]);
    }

    public function user(Request $request)
    {
        return response()->json(['user' => $request->user()]);
    }
}
