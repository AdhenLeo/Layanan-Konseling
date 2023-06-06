<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostPenggunaRequest;
use App\Http\Requests\UpdatePenggunaRequest;
use App\Models\Kelas;
use App\Models\Pengguna;
use App\Models\PenggunaKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PenggunaController extends Controller
{
    public function index()
    {
        $datas = Pengguna::with(['kelas'])->paginate(4);
        return view('pengguna.index', compact('datas'));
    }

    public function create()
    {
        $jk = ['L','P'];
        $roles = ['super admin','admin','user'];
        $datas = Kelas::all();
        return view('pengguna.form', compact('datas', 'jk', 'roles'));
    }

    public function store(PostPenggunaRequest $request)
    {
        try {
            $data = [
                'nama' => $request->nama,
                'jk' => $request->jk,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            if($request->profile){
                $path = Storage::disk('public')->putFile('profile', $request->profile);
                $data['profile'] = $path;
            }
            
            $pengguna = Pengguna::create($data);
            foreach ($request->kelas_id as $kelas) {
                PenggunaKelas::create(['kelas_id' => $kelas, 'pengguna_id' => $pengguna->id]);
            }

            return redirect()->route('pengguna.index')->with('msg_success', 'Berhasil menambahkan pengguna');
        } catch (\Throwable $th) {
            return redirect()->route('pengguna.index')->with('msg_error', 'Gagal menambahkan pengguna');
        }
    }

    public function show(Pengguna $pengguna)
    {
        //
    }

    public function edit(Pengguna $pengguna)
    {
        $jk = ['L','P'];
        $roles = ['super admin','admin','user'];
        $datas = Kelas::all();
        $data = $pengguna;
        return view('pengguna.form', compact('data','datas','jk','roles'));
    }

    public function update(UpdatePenggunaRequest $request, Pengguna $pengguna)
    {
        try {
            $kelas = PenggunaKelas::where('pengguna_id', $pengguna->id)->get();
            $data = [
                'nama' => $request->nama,
                'jk' => $request->jk,
                'email' => $request->email,
            ];
            
            if($request->profile){
                $path = Storage::disk('public')->putFile('profile', $request->profile);
                $data['profile'] = $path;
            }
            
            $request->password ? $data['password'] = Hash::make($request->password) : '';
            
            if(Storage::disk('public')->exists("$pengguna->profile")){
                Storage::disk('public')->delete("$pengguna->profile");
            }
            $pengguna->update($data);
            foreach ($request->kelas_id as $kelas) {
                $kelas->update(['kelas_id' => $kelas]);
            }

            return redirect()->route('pengguna.index')->with('msg_success', 'Berhasil mengubah pengguna');
        } catch (\Throwable $th) {
            return redirect()->route('pengguna.index')->with('msg_error', 'Gagal mengubah pengguna');
        }
    }

    public function destroy(Pengguna $pengguna)
    {
        if(!$pengguna) return abort(404);

        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('msg_success', 'Berhasil menghapus pengguna');
    }
}
