<?php

namespace App\Http\Controllers;

use App\Exports\UserPetaKerawananExport;
use App\Models\{
    Kelas,
    PetaKerawanan,
    User,
    UserPetaKerawanan
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UserPetaKerawananController extends Controller
{
    public function index()
    {
        return view('user.show');
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        $datas = UserPetaKerawanan::with('peta_kerawanan', 'user')->where('user_id', $id)->get();
        return view('profile.partials.userpetakerawanan', compact('datas'));
    }

    public function showpeta($id)
    {
        try {
            $data = User::find($id); 
            $petakerawanans = PetaKerawanan::with('user')->get();
            $datas = UserPetaKerawanan::with('peta_kerawanan', 'user')->where('user_id', $id)->get();
            $datapeta = [];
            foreach($datas as $i => $peta){
                $datapeta[] = $peta->peta_kerawanan_id;
            }
            return view('user.partials.checkboxpetakerawanan', compact('datapeta', 'datas', 'petakerawanans'));
        } catch (\Throwable $th) {
            return 'msg_error';
        }
    }

    public function edit($id)
    {
        $data = User::find($id); 
        $petakerawanans = PetaKerawanan::with('user')->get();
        $datas = UserPetaKerawanan::with('peta_kerawanan', 'user')->where('user_id', $id)->get();
        $datapeta = [];
        foreach($datas as $i => $peta){
            $datapeta[] = $peta->peta_kerawanan_id;
        }
        return view('user.form', compact('datas', 'petakerawanans', 'datapeta', 'data'));
    }

    public function update(Request $request, $id)
    {
        try {
            $siswa = User::find($id);
            $datasiswa = [
                'ket' => $request->ket
            ];
            
            // menambahkan peta kerawanan ke siswa
            if(isset($request->peta_kerawanan_id)){
                foreach ($request->peta_kerawanan_id as $i => $petakerawanan) {
                    $data = UserPetaKerawanan::create(['user_id' => $id, 'peta_kerawanan_id' => $petakerawanan]);
                }
            }

            // mengisi kesimpulan peta kerawanan
            $siswa->update($datasiswa);

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

    public function export($id){
        $kelas = Kelas::find($id);
        return Excel::download(new UserPetaKerawananExport($id),"Peta Kerawanan $kelas->nama.xlsx");
    }
}
