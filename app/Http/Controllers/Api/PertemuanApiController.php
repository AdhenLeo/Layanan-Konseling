<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $datas = Pertemuan::with('user', 'guru')->where('user_id', $id)->get();
        
        if(!isset($datas)){
            $this->response['status'] = 404;
            $this->response['messages'] = 'Not Found';
            $this->response['data'] = 'Hasil pertemuan belum tersedia';

            return response()->json($this->response);
        }

        $this->response['status'] = 200;
        $this->response['messages'] = 'Success';
        $this->response['data'] = $datas;

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
