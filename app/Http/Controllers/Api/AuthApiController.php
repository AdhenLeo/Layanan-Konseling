<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};

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
            $data = Pengguna::where('email', $request->email)->first();

            if (!$data || !Hash::check($request->password, $data->password)) {
                $this->response['status'] = 404;
                $this->response['message'] = 'failed';
                $this->response['data'] = 'Email atau password salah!';

                return response()->json($this->response);
            }

            $token = $data->createToken($request->device_name)->plainTextToken;

            $this->response['status'] = 200;
            $this->response['messages'] = 'success';
            $this->response['data'] = ['token' => $token];

            return response()->json($this->response);
        } catch (\Throwable $th) {
            $this->response['messages'] = 'failed';
            $this->response['data'] = $th;

            return response()->json($this->response);
        }
    }
}
