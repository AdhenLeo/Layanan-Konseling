<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function viewLogin()
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $data = Pengguna::where('email', $request->email)->first();

        if(!$data || !Hash::check($request->password, $data->password)){
            return redirect()->route('auth.login')->with('msg_error', 'Email atau password salah');
        }

        Auth::login($data);

        return redirect()->route('dashboard')->with('msg_success', 'Berhasil melakukan login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('auth.login')->with('msg_success', 'Berhasil melakukan logout');
    }
}
