<?php

namespace App\Http\Controllers;

use App\Models\UserPetaKerawanan;
use Illuminate\Http\Request;

class UserPetaKerawananController extends Controller
{
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
        
    }

    public function show(UserPetaKerawanan $userPetaKerawanan)
    {
        //
    }

    public function edit(UserPetaKerawanan $userPetaKerawanan)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            foreach ($request->jenis as $i => $petakerawanan) {
                $data = UserPetaKerawanan::create(['user_id' => $id, 'peta_kerawanan_id' => $petakerawanan]);
            }
            return back()->with('msg_success', "Berhasil menambahkan petakerawanan kepada siswa");
        } catch (\Throwable $th) {
            return back()->with('msg_error', "Gagal menambahkan petakerawanan kepada siswa");
        }
    }

    public function destroy(UserPetaKerawanan $userPetaKerawanan)
    {
        //
    }
}
