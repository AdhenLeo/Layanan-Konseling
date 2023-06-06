<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostPenggunaRequest;
use App\Http\Requests\UpdatePenggunaRequest;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaApiController extends Controller
{
    private $response = [
        'status' => null,
        'messages' => null,
        'data' => null,
    ];

    public function index()
    {
        $data = Pengguna::whereNo('role', 'super admin')->get();

        $this->response['status'] = 200;
        $this->response['messages'] = 'success';
        $this->response['data'] = $data;

        return response()->json($this->response, 200);
    }

    public function create()
    {
        //
    }

    public function store(PostPenggunaRequest $request)
    {
        try {
            $data = [];

            $pengguna = Pengguna::create($data);

            $this->response['status'] = 200;
            $this->response['messages'] = 'success';
            $this->response['data'] = $pengguna;

            return response()->json($this->response, 200);
        } catch (\Throwable $th) {
            $this->response['messages'] = 'failed';
            $this->response['data'] = $th;

            return response()->json($this->response);
        }
    }

    public function show(Pengguna $pengguna)
    {
        //
    }

    public function edit(Pengguna $pengguna)
    {
        //
    }

    public function update(UpdatePenggunaRequest $request, Pengguna $pengguna)
    {
        try {
            $data = [];

            $pengguna->update($data);

            $this->response['status'] = 200;
            $this->response['messages'] = 'success';
            $this->response['data'] = $pengguna;

            return response()->json($this->response, 200);
        } catch (\Throwable $th) {
            $this->response['messages'] = 'failed';
            $this->response['data'] = $th;

            return response()->json($this->response);
        }
    }

    public function destroy(Pengguna $pengguna)
    {
        if (!$pengguna) {
            $this->response['messages'] = 'failed';
            $this->response['data'] = 'Not Found!';

            return response()->json($this->response);
        }

        $pengguna->delete();

        $this->response['status'] = 200;
        $this->response['messages'] = 'success';
        $this->response['data'] = 'Success Delete';

        return response()->json($this->response, 200);
    }
}
