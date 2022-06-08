<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class APILoginController extends Controller
{
    public function authenticate(Request $request)
    {
        // dd($request);
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $token = $user->createToken('tkn')->plainTextToken;
            $data = [
                'token'=>$token,
                'user'=>$user,
            ];
            // dd($data);
            return response($data, 200);
        }
        return response("Email or Password wrong", 400);
    }

    public function getUserbyToken(Request $request){
        try {
            $user = Auth::user();
            return response($user, 200);
        } catch (\Exception $e) {
            return response($e, 500);
        }
    }

    public function logout(Request $request){
        // Auth::user()->tokens()->delete();
        try {
            Auth::guard('web')->logout();
            auth()->user()->tokens()->delete();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return response("sukses", 200);
        } catch (\Exception $e) {
            return response($e, 500);
        }
    }
}
