<?php

namespace App\Http\Controllers;

use App\Http\Requests\walas\{
    PostWalasRequest,
    UpdateWalasRequest
};
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Hash,
    Storage
};

class WaliKelasController extends Controller
{
    public function index()
    {
        $datas = WaliKelas::paginate(4);
        return view('walas.index', compact('datas'));
    }

    public function create()
    {
        return view('walas.form');
    }

    public function store(PostWalasRequest $request)
    {
        try {
            $data = [
                'kelas_id' =>$request->kelas_id
            ];

            if($request->profile){
                $path = Storage::disk('public')->putFile('profile', $request->profile);
            
                $data['profile'] = $path;
            }
            
            $walas = WaliKelas::create($data);

            return redirect()->route('walas.index')->with('msg_success', 'Berhasil menambahkan wali kelas');
        } catch (\Throwable $th) {
            return redirect()->route('walas.index')->with('msg_error', 'Gagal menambahkan wali kelas');
        }
    }

    public function show(WaliKelas $waliKelas)
    {
        $data = $waliKelas;
        return view('walas.show', compact('data'));
    }

    public function edit(WaliKelas $waliKelas)
    {
        $data = $waliKelas;
        return view('walas.form', compat('data'));
    }

    public function update(UpdateWalasRequest $request, WaliKelas $waliKelas)
    {
        try {
            $data = [
                'kelas_id' => $request->kelas_id
            ];

            if($request->profile){
                $path = Storage::disk('public')->putFile('profile', $request->profile);
                $data['profile'] = $path;
            }

            $request->password ? $data['password'] = Hash::make($request->password) : '';
            
            if(Storage::disk('public')->exists("$waliKelas->profile")){
                Storage::disk('public')->delete("$waliKelas->profile");
            }
            
            $waliKelas->update($data);

            return redirect()->route('walas.index')->with('msg_success', 'Berhasil mengubah wali kelas');
        } catch (\Throwable $th) {
            return redirect()->route('walas.index')->with('msg_error', 'Gagal mengubah wali kelas');
        }
    }

    public function destroy(WaliKelas $waliKelas)
    {
        if(!$waliKelas) return abort(404);

        $waliKelas->delete();

        return redirect()->route('walas.index')->with('msg_success', 'Berhasil menghapus wali kelas');
    }
}
