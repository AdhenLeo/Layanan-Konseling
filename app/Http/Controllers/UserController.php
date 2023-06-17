<?php

namespace App\Http\Controllers;

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
    PetaKerawanan,
    UserKelas,
    UserPetaKerawanan,
    WaliKelas
};
use Illuminate\Support\Facades\{
    Hash,
    Storage
};
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('isCantSiswa');
    }

    public function index()
    {
        $datas = User::with('kelas')->whereNot('role', 'admin')->paginate(4);
        return view('user.index', compact('datas'));
    }

    public function create()
    {
        $jk = ['L','P'];
        $roles = ['guru','walas', 'user'];
        $datas = Kelas::all();
        return view('user.form', compact('datas', 'jk', 'roles'));
    }

    public function store(PostUserRequest $request)
    {
        try {
            $data = [
                'nama' => $request->nama,
                'nip' => $request->nip,
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

            foreach($request->kelas_id as $kelas){
                UserKelas::create(['user_id' => $user->id, 'kelas_id' => $kelas]);
            }
            // mengecek role
            $request->role == 'guru' ? $this->storeGuru($request->all(), $user->id) : ($request->role == 'walas' ? $this->storeWalas($request->all(), $user->id) : null);

            return redirect()->route('user.index')->with('msg_success', 'Berhasil menambahkan user');
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('msg_error', 'Gagal menambahkan user');
        }
    }

    public function show($id)
    {
        $data = User::with('kelas')->find($id); 
        $petakerawanans = PetaKerawanan::with('user')->get();
        $datas = UserPetaKerawanan::with('peta_kerawanan', 'user')->where('user_id', $id)->get();
        $datapeta = [];
        foreach($datas as $i => $peta){
            $datapeta[] = $peta->peta_kerawanan_id;
        }
        return view('user.petakerawanan.form', compact('data', 'petakerawanans', 'datapeta'));
    }

    public function edit(User $user)
    {
        $jk = ['L','P'];
        $roles = ['guru','walas', 'user'];
        $datas = Kelas::all();
        $data = $user;
        return view('user.form', compact('data','datas','jk','roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = [
                'nama' => $request->nama,
                'email' => $request->email,
            ];

            $request->nip ? $data['nip'] = $request->nip : null;

            $request->role ? $data['role'] = $request->role : null;
            
            $request->jk ? $data['jk'] = $request->jk : null;

            if($request->profile){
                $path = Storage::disk('public')->putFile('profile', $request->profile);
                $data['profile'] = $path;
                if(Storage::disk('public')->exists("$user->profile")){
                    Storage::disk('public')->delete("$user->profile");
                }
            }

            $request->password ? $data['password'] = Hash::make($request->password) : '';

            $user->update($data);

            $request->role == 'guru' ? $this->updateGuru($request->all(), $user->id) : null;

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
                'biodata' => $request['biodata'],
                'visi' => $request['visi'],
                'misi' => $request['misi'],
            ];

            $guru = Guru::create($data);

        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('msg_error', 'Gagal mengubah user');
        }
    }

    public function updateGuru($request, $user_id)
    {
        try {
            $guru = Guru::where('user_id', $user_id)->first();
            $data = [
                'user_id' => $user_id,
                'biodata' => $request['biodata'],
                'visi' => $request['visi'],
                'misi' => $request['misi'],
            ];

            $guru->update($data);

        } catch (\Throwable $th) {
            dd("not success: ". $th);
            return redirect()->route('guru.index')->with('msg_error', 'Gagal menambahkan guru');
        }
    }
}
