<?php

namespace App\Http\Controllers;

use App\Http\Requests\pertemuan\{
    PostPertemuanRequest,
    UpdatePertemuanRequest
};
use App\Models\Pertemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PertemuanController extends Controller
{
    public function index()
    {
        $datas = Pertemuan::with('siswa', 'guru')->get();
        dd($datas);
        return view('pertemuan.index');
    }
    public function create()
    {
        return view('pertemuan.form');
    }

    public function store(PostPertemuanRequest $request)
    {
        try {
            $data = [
                'user_id' => Auth::check() ? (Auth::user()->role == 'user' ? Auth::user()->id : $request->user_id) : null,
                'guru_id' => Auth::check() ? (Auth::user()->role == 'guru' ? Auth::user()->id : $request->guru_id) : null,
                'tema' => $request->tema,
                'tgl' => $request->tgl,
                'tmpt' => $request->tmpt,
                'deskripsi' => $request->deskripsi,
                'status' => Auth::check() ? (Auth::user()->role == 'guru' ? 'done' : 'waiting') : null
            ];
            
            
            $pertemuan = Pertemuan::create($data);
            dd($pertemuan);

            return redirect()->route('pertemuan.index')->with('msg_success', 'Berhasil menambahkan pertemuan');
        } catch (\Throwable $th) {
            return redirect()->route('pertemuan.index')->with('msg_error', 'Gagal menambahkan pertemuan');
        }
    }

    public function show(Pertemuan $pertemuan)
    {
        $data = Pertemuan::find($pertemuan->id);
        return view('pertemuan.show', compact('data'));
    }

    public function edit(Pertemuan $pertemuan)
    {
        $data = $pertemuan;
        return view('pertemuan.form', compact('data'));
    }

    public function update(UpdatePertemuanRequest $request, Pertemuan $pertemuan)
    {
        try {
            $data = [
                'tgl' => $request->tgl,
                'tmpt' => $request->tmpt,
            ];

            $pertemuan->update($data);

            return redirect()->route('pertemuan.index')->with('msg_success', 'Berhasil mengubah pertemuan');
        } catch (\Throwable $th) {
            return redirect()->route('pertemuan.index')->with('msg_error', 'Gagal mengubah pertemuan');
        }
    }

    public function destroy(Pertemuan $pertemuan)
    {
        if(!$pertemuan) return abort(404);

        $pertemuan->delete();

        return redirect()->route('pertemuan.index')->with('msg_success', 'Berhasil menghapus pertemuan');
    }
}
