<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Login Page'
        ];
        return view('auth.login', $data);
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $link = '/404';

            if (Auth::user()->role_id == 1) $link = route('admin.dashboard');
            elseif (Auth::user()->role_id == 2) $link = route('user.dashboard');

            return response()->json([
                'link' => $link,
            ], 200);
        } else {
            return response()->json([
                'msg' => 'akun tidak ditemukan',
            ], 400);
        }
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }
}
