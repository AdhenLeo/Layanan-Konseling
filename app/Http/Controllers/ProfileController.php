<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use App\Models\UserKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }
    
    public function formProfile(){
        $data = User::with('kelas')->find(Auth::user()->id);
        $dataKelas = Kelas::all();
        $datas = UserKelas::with('kelas', 'user')->where('user_id', Auth::user()->id)->get();
        $datakelass = [];
        foreach($datas as $i => $kelas){
            $datakelass[] = $kelas->kelas_id;
        }

        return view('profile.form', compact('data', 'dataKelas', 'datakelass'));
    }
    
    public function create()
    {
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $data = [
                'nama' => $request->nama,
                'email' => $request->email,
            ];

            if($request->hasFile('profile')){
                $path = Storage::disk('public')->putFile('profile', $request->profile);
                $data['profile'] = $path;

                // menghapus foto di storage
                if(Storage::disk('public')->exists("$user->profile")){
                    Storage::disk('public')->delete("$user->profile");
                }
            }
            
            $request->password ? $data['password'] = Hash::make($request->password) : '';
            

            $user->update($data);

            return back()->with('msg_success', 'Berhasil mengubah user');
        } catch (\Throwable $th) {
            return back()->with('msg_error', 'Gagal mengubah user');
        }
    }


    public function destroy($id)
    {
        //
    }
}
