<?php

namespace App\Http\Controllers;

use App\Http\Requests\guru\PostGuruRequest;
use App\Http\Requests\user\{
    PostUserRequest,
    UpdateUserRequest
};
use App\Models\{
    Guru,
    User,
    Kelas,
    Pengguna,
    PenggunaKelas,
    WaliKelas
};
use Illuminate\Support\Facades\{
    Hash,
    Storage
};
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $datas = User::paginate(4);
        return view('user.index', compact('datas'));
    }

    public function create()
    {
        $jk = ['L','P'];
        $roles = ['admin','guru','walas', 'user'];
        $datas = Kelas::all();
        return view('user.form', compact('datas', 'jk', 'roles'));
    }

    public function store(PostUserRequest $request)
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
            
            $user = User::create($data);
            
            // mengecek role
            $request->role == 'guru' ? $this->storeGuru($request->all(), $user->id) : ($request->role == 'walas' ? $this->storeWalas($request->all(), $user->id) : null);
            // $request->role == 'walas' ? $this->storeWalas($request->all(), $user->id) : null;


            return redirect()->route('user.index')->with('msg_success', 'Berhasil menambahkan user');
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('msg_error', 'Gagal menambahkan user');
        }
    }

    public function show(User $user)
    {
        return view('user.show');
    }

    public function edit(User $user)
    {
        $jk = ['L','P'];
        $roles = ['admin','guru','walas', 'user'];
        $datas = Kelas::all();
        $data = $user;
        return view('user.form', compact('data','datas','jk','roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            // $kelas = PenggunaKelas::where('user_id', $user->id)->get();
            $data = [
                'nama' => $request->nama,
                'jk' => $request->jk,
                'email' => $request->email,
                'role' => $request->role
            ];
            
            if($request->profile){
                $path = Storage::disk('public')->putFile('profile', $request->profile);
                $data['profile'] = $path;
            }
            
            $request->password ? $data['password'] = Hash::make($request->password) : '';
            
            if(Storage::disk('public')->exists("$user->profile")){
                Storage::disk('public')->delete("$user->profile");
            }
            $user->update($data);

            $request->role == 'guru' ? $this->updateGuru($request->all(), $user->id) : ($request->role == 'walas' ? $this->updateWalas($request->all(), $user->id) : null);
            // foreach ($request->kelas_id as $kelas) {
            //     $kelas->update(['kelas_id' => $kelas]);
            // }

            return redirect()->route('user.index')->with('msg_success', 'Berhasil mengubah user');
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('msg_error', 'Gagal mengubah user');
        }
    }

    public function destroy(User $user)
    {
        if(!$user) return abort(404);

        $user->delete();

        return redirect()->route('user.index')->with('msg_success', 'Berhasil menghapus user');
    }

    // costum function
    public function storeGuru($request, $user_id)
    {
        try {
            $data = [
                'user_id' => $user_id,
                'visi' => $request['visi'],
                'misi' => $request['misi'],
            ];

            $guru = Guru::create($data);
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

    public function updateGuru($request, $user_id)
    {
        try {
            $guru = Guru::where('user_id', $user_id)->first();
            $data = [
                'user_id' => $user_id,
                'visi' => $request['visi'],
                'misi' => $request['misi'],
            ];
            
            $guru->update($data);
            // dd($guru);
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

    public function storeWalas($request, $user_id)
    {
        try {
            $data = [
                'user_id' =>$user_id,
                'kelas_id' =>$request['kelas_id']
            ];

            $walas = WaliKelas::create($data);
            dd('success: '. $walas);

            return redirect()->route('walas.index')->with('msg_success', 'Berhasil menambahkan wali kelas');
        } catch (\Throwable $th) {
            return redirect()->route('walas.index')->with('msg_error', 'Gagal menambahkan wali kelas');
        }
    }

    public function updateWalas($request, $user_id)
    {
        try {
            $walas = WaliKelas::where('user_id', $user_id)->first();
            $data = [
                'user_id' =>$user_id,
            ];

            isset($request['kelas_id']) ? $data['kelas_id'] = $request['kelas_id'] : '';

            $walas->update($data);
            dd('success: '. $walas);
            
            return redirect()->route('walas.index')->with('msg_success', 'Berhasil menambahkan wali kelas');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('walas.index')->with('msg_error', 'Gagal menambahkan wali kelas');
        }
    }
}
