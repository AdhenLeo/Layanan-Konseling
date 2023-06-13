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
        
        // if($request->remember == 'on'){
        //     $response = response('cookie');
        //     $response->withCookie('email_nisn_nip', $request->email, 1);
        //     $response->withCookie('password', $request->password, 1);
        // }

        $login = Auth::login($data);
        Auth::user()->role != 'admin' ? insertLog('login') : null;

        return redirect()->route('dashboard')->with('msg_success', 'Berhasil melakukan login');
    }

    public function logout()
    {
        Auth::user()->role != 'admin' ? insertLog('logout') : null;
        Auth::logout();

        return redirect()->route('auth.login')->with('msg_success', 'Berhasil melakukan logout');
    }
}
