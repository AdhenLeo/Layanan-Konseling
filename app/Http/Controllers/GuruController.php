<?php

namespace App\Http\Controllers;

use App\Http\Requests\guru\{
    PostGuruRequest,
    UpdateGuruRequest
};
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Hash,
    Storage
};

class GuruController extends Controller
{
    public function index()
    {
        $datas = Guru::paginate(4);
        return view('guru.index', compact('datas'));
    }

    public function create()
    {
        return view('guru.form');
    }

    public function store(PostGuruRequest $request)
    {
        try {
            $data = [
                'nama' => $request->nama,
                'jk' => $request->jk,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ];

            if($request->profile){
                $path = Storage::disk('public')->putFile('profile', $request->profile);
            
                $data['profile'] = $path;
            }
            
            $pengguna = Guru::create($data);
            dd("success");
            // foreach ($request->kelas_id as $kelas) {
            //     // PenggunaKelas::create(['kelas_id' => $kelas, 'pengguna_id' => $pengguna->id]);
            // }

            return redirect()->route('guru.index')->with('msg_success', 'Berhasil menambahkan guru');
        } catch (\Throwable $th) {
            dd("not success: ". $th);
            return redirect()->route('guru.index')->with('msg_error', 'Gagal menambahkan guru');
        }
    }

    public function show(Guru $guru)
    {
        $data = $guru;
        return view('guru.show', compact('data'));
    }

    public function edit(Guru $guru)
    {
        $data = $guru; 
        return view('guru.form', compact('data'));
    }

    public function update(UpdateGuruRequest $request, Guru $guru)
    {
        try {
            $data = [

            ];

            if($request->profile){
                $path = Storage::disk('public')->putFile('profile', $request->profile);
                $data['profile'] = $path;
            }

            $request->password ? $data['password'] = Hash::make($request->password) : '';
            
            if(Storage::disk('public')->exists("$guru->profile")){
                Storage::disk('public')->delete("$guru->profile");
            }
            
            if($request->kelas_id){
                foreach ($request->kelas_id as $kelas) {
                    // PenggunaKelas::create(['kelas_id' => $kelas, 'pengguna_id' => $pengguna->id]);
                }
            }

            $guru->update($data);
            

            return redirect()->route('guru.index')->with('msg_success', 'Berhasil mengubah guru');
        } catch (\Throwable $th) {
            return redirect()->route('guru.index')->with('msg_error', 'Gagal mengubah guru');
        }
    }

    public function destroy(Guru $guru)
    {
        if(!$guru) return abort(404);

        $guru->delete();

        return redirect()->route('guru.index')->with('msg_success', 'Berhasil menghapus guru');
    }
}
