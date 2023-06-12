<?php

namespace App\Http\Controllers;

use App\Models\PetaKerawanan;
use App\Models\UserPetaKerawanan;
use Illuminate\Http\Request;

class UserPetaKerawananController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        $datas = UserPetaKerawanan::with('peta_kerawanan', 'user')->where('user_id', $id)->get();
        return view('profile.partials.userpetakerawanan', compact('datas'));
    }

    public function edit($id)
    {
        $petakerawanans = PetaKerawanan::with('user')->get();
        $datas = UserPetaKerawanan::with('peta_kerawanan', 'user')->where('user_id', $id)->get();
        $datapeta = [];
        foreach($datas as $i => $peta){
            $datapeta[] = $peta->peta_kerawanan_id;
        }
        return view('profile.form', compact('datas', 'petakerawanans', 'datapeta'));
    }

    public function update(Request $request, $id)
    {
        try {
            foreach ($request->peta_kerawanan_id as $i => $petakerawanan) {
                $data = UserPetaKerawanan::create(['user_id' => $id, 'peta_kerawanan_id' => $petakerawanan]);
            }
            return back()->with('msg_success', "Berhasil menambahkan petakerawanan kepada siswa");
        } catch (\Throwable $th) {
            return back()->with('msg_error', "Gagal menambahkan petakerawanan kepada siswa");
        }
    }

    public function destroy($id)
    {
        try {
            $userPetaKerawanan = UserPetaKerawanan::find($id);
            if(!$userPetaKerawanan){
                return 'msg_not_found'; 
            }

            $userPetaKerawanan->delete();
            return 'msg_success';
        } catch (\Throwable $th) {
            return "msg_error";
        }
    }
}
