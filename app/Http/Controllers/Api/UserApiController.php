<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\{
    PostUserRequest,
    UpdateUserRequest
};
use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    private $response = [
        'status' => null,
        'messages' => null,
        'data' => null
    ];

    public function index()
    {
        $data = User::whereNot('role', 'super admin')->get();

        $this->response['status'] = 200;
        $this->response['messages'] = 'success';
        $this->response['data'] = $data;

        return response()->json($this->response, 200);
    }

    public function create()
    {
        //
    }

    public function store(PostUserRequest $request)
    {
        try {
            $data = [];

            $user = User::create($data);

            $this->response['status'] = 200;
            $this->response['messages'] = 'success';
            $this->response['data'] = $user;

            return response()->json($this->response, 200);
        } catch (\Throwable $th) {
            $this->response['messages'] = 'failed';
            $this->response['data'] = $th;

            return response()->json($this->response);
        }
    }

    public function show(User $user)
    {
        
    }

    public function edit(User $user)
    {
        //
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = [];

            $user->update($data);

            $this->response['status'] = 200;
            $this->response['messages'] = 'success';
            $this->response['data'] = $user;

            return response()->json($this->response, 200);
        } catch (\Throwable $th) {
            $this->response['messages'] = 'failed';
            $this->response['data'] = $th;

            return response()->json($this->response);
        }
    }

    public function destroy(User $user)
    {
        if (!$user) {
            $this->response['messages'] = 'failed';
            $this->response['data'] = 'Not Found!';

            return response()->json($this->response);
        }

        $user->delete();

        $this->response['status'] = 200;
        $this->response['messages'] = 'success';
        $this->response['data'] = 'Success Delete';

        return response()->json($this->response, 200);
    }
}
