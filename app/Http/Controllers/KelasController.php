<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $datas = Kelas::paginate(4);
        return view('kelas.index', compact('datas'));
    }

    public function create()
    {
        return view('kelas.form');
    }

    public function store(PostKelasRequest $request)
    {
        try {
            $data = [
                'nama' => $request->nama
            ];

            $kelas = Kelas::create($data);

            return redirect()->route('kelas.index')->with('msg_success', 'Berhasil menambahkan kelas');
        } catch (\Throwable $th) {
            return redirect()->route('kelas.index')->with('msg_error', 'Gagal menambahkan kelas');
        }
    }

    public function show(Kelas $kelas)
    {
        return view('kelas.show', compact('kelas'));
    }

    public function edit($id)
    {
        $data = Kelas::find($id);
        return view('kelas.form', compact('data'));
    }

    public function update(UpdateKelasRequest $request, $id)
    {
        try {
            $kelas = Kelas::find($id);
            $data = [
                'nama' => $request->nama
            ];

            $kelas->update($data);

            return redirect()->route('kelas.index')->with('msg_success', 'Berhasil mengubah kelas');
        } catch (\Throwable $th) {
            return redirect()->route('kelas.index')->with('msg_error', 'Gagal mengubah kelas');
        }
    }

    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        if(!$kelas) return abort(404);

        $kelas->delete();

        return redirect()->route('kelas.index')->with('msg_success', 'Berhasil menghapus kelas');
    }
}
