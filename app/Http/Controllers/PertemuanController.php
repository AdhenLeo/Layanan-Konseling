<?php

namespace App\Http\Controllers;

use App\Http\Requests\pertemuan\{
    PostPertemuanRequest,
    UpdatePertemuanRequest
};
use App\Models\{
    Guru,
    Pertemuan,
    User,
    UserKelas
};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PertemuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('isCantWalas');
        $this->middleware('isCantAdmin');
    }
    public function index()
    {
        $datas = Auth::user()->role == 'guru' ? Pertemuan::with('user', 'guru')->where('guru_id', Auth::user()->id)->orderBy('tgl', 'DESC')->paginate(4) : Pertemuan::with('user', 'guru')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(4);

        return view('pertemuan.index', compact('datas'));
    }
    public function create()
    {
        $temas = ['Bimbingan Pribadi', 'Bimbingan Sosial', 'Bimbingan Karir', 'Bimbingan Belajar'];
        $jeniskarirs = ['Bekerja', 'Kuliah', 'Wirausaha',];
        $siswas = getSiswaGuru();
        
        return view('pertemuan.form', compact('temas','jeniskarirs', 'siswas'));
    }

    public function store(PostPertemuanRequest $request)
    {
        try {
            $guru = getGuruSiswa();
            $data = [
                'user_id' => Auth::user()->role == 'user' ? Auth::user()->id : $request->user_id,
                'guru_id' => Auth::user()->role == 'guru' ? Auth::user()->id : $guru->user->id,
                'tema' => $request->tema,
                'tgl' => Carbon::parse($request->tgl),
                'tmpt' => $request->tmpt,
                'deskripsi' => $request->deskripsi,
                'status' => Auth::user()->role == 'guru' ? 'accept' : 'waiting',
            ];

            $request->tema == 'Bimbingan Karir' && isset($request->jenis_karir) ? $data['jenis_karir'] = $request->jenis_karir : null; 
            
            $pertemuan = Pertemuan::create($data);

            return redirect()->route('pertemuan.index')->with('msg_success', 'Berhasil membuat pertemuan');
        } catch (\Throwable $th) {
            return redirect()->route('pertemuan.index')->with('msg_error', 'Gagal membuat pertemuan');
        }
    }

    public function show($id)
    {
        $data = Pertemuan::find($id);
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
            $data = [];
            
            $request->tgl ? $data['tgl'] = Carbon::parse($request->tgl) : null;
            $request->tmpt ? $data['tmpt'] = $request->tmpt : null;
            $request->tgl && $request->tmpt ? $data['status'] = 'pending' : $data['status'] = 'accept';
            $request->kesimpulan ? $data['kesimpulan'] = $request->kesimpulan : null;
            $request->kesimpulan ? $data['status'] = 'done' : null;
            

            $pertemuan->update($data);

            return back()->with('msg_success', 'Berhasil mengubah pertemuan');
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
