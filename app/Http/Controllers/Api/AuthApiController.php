<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash, Storage};

class AuthApiController extends Controller
{
    private $response = [
        'status' => null,
        'messages' => null,
        'data' => null,
    ];

    public function postLogin(LoginRequest $request)
    {
        try {
            $data = User::where('email', $request->email)->first();
            
            if (!$data || !Hash::check($request->password, $data->password)) {
                $this->response['status'] = 404;
                $this->response['messages'] = 'failed';
                $this->response['data'] = 'Email atau password salah!';

                return response()->json($this->response);
            }
            
            $token = $data->createToken($request->device_name)->plainTextToken;
            insertLog('login', $data->id);

            $data->profile = Storage::disk('public')->exists($data->profile) ? Storage::disk('public')->url($data->profile) : asset($data->profile);

            $this->response['status'] = 200;
            $this->response['messages'] = 'success';
            $this->response['data'] = ['user' => $data,'token' => $token];

            return response()->json($this->response);
        } catch (\Throwable $th) {
            $this->response['status'] = 404;
            $this->response['messages'] = 'failed';
            $this->response['data'] = $th;

            return response()->json($this->response);
        }
    }

    public function postLogout()
    {
        $logout = auth()->user()->currentAccessToken()->delete();

        $this->response['status'] = 200;
        $this->response['messages'] = 'success';

        return response()->json($this->response, 200);
    }
}
