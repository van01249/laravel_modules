<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginAdmin(LoginRequest $request)
    {
        $login = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'is_admin' => 1
        ]);

        if ($login)
            return redirect()->route('admin.dashboard');

        return back();
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'result' => 'true',
            'message' => 'Đăng xuất thành công'
        ]);
    }
}
