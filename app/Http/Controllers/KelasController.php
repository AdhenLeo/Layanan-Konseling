<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use App\Models\Kelas;
use App\Models\User;
use App\Models\UserKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('AdminOrGuruOrWalas');
    }

    public function index()
    {
        $datas = Kelas::paginate(4);
        $kelas = UserKelas::with('user', 'kelas')->where('user_id', Auth::user()->id)->get();
        return view('kelas.index', compact('datas', 'kelas'));
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

    public function show($id)
    {
        $datas = Kelas::with('user')->find($id);
        return view('kelas.show', compact('datas'));
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
        if (!$kelas) return abort(404);

        $kelas->delete();

        return redirect()->route('kelas.index')->with('msg_success', 'Berhasil menghapus kelas');
    }
}
