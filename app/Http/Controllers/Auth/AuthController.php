<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    Hash,
};

class AuthController extends Controller
{
    public function viewLogin()
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $data = User::where('email', $request->email)->first();
        
        if(!$data || !Hash::check($request->password, $data->password)){
            return redirect()->route('auth.login')->with('msg_error', 'Email atau password salah');
        }
        
        $login = Auth::login($data);
        // dd(Auth::user()->id);
        insertLog('login');
        dd("success login");

        return redirect()->route('dashboard')->with('msg_success', 'Berhasil melakukan login');
    }

    public function logout()
    {
        insertLog('logout');
        Auth::logout();

        return redirect()->route('auth.login')->with('msg_success', 'Berhasil melakukan logout');
    }
}
