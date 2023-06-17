<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{
    Pertemuan,
    User
};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PertemuanApiController extends Controller
{
    private $response = [
        'status' => null,
        'messages' => null,
        'data' => null,
    ];

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $req)
    {
        $user = User::find($req->id);
        $user->profile = Storage::disk('public')->exists($user->profile) ? Storage::disk('public')->url($user->profile) : asset($user->profile);

        $datas = Pertemuan::with('user', 'guru')->where('user_id', $req->id)->get();
        
        if(!isset($datas)){
            $this->response['status'] = 404;
            $this->response['messages'] = 'Not Found';
            $this->response['data'] = 'Hasil pertemuan belum tersedia';

            return response()->json($this->response);
        }

        $this->response['status'] = 200;
        $this->response['messages'] = 'Success';
        $this->response['data'] = [
            'data' => $datas,
            'user' => $user
        ];

        return response()->json($this->response);
    }

    public function show(Request $req)
    {
        $user = User::find($req->id);
        $user->profile = Storage::disk('public')->exists($user->profile) ? Storage::disk('public')->url($user->profile) : asset($user->profile);

        $datas = Pertemuan::with('user', 'guru')->where('user_id', $req->id)->get();
        
        if(!isset($datas)){
            $this->response['status'] = 404;
            $this->response['messages'] = 'Not Found';
            $this->response['data'] = 'Hasil pertemuan belum tersedia';

            return response()->json($this->response);
        }

        $this->response['status'] = 200;
        $this->response['messages'] = 'Success';
        $this->response['data'] = [
            'data' => $datas,
            'user' => $user
        ];

        return response()->json($this->response);
        
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
