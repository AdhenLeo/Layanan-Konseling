<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\{
    PostUserRequest,
    UpdateUserRequest
};
use App\Models\{
    User,
    Kelas,
    Pengguna,
    PenggunaKelas
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
        $datas = User::with(['kelas'])->paginate(4);
        return view('user.index', compact('datas'));
    }

    public function create()
    {
        $jk = ['L','P'];
        $datas = Kelas::all();
        return view('user.form', compact('datas', 'jk'));
    }

    public function store(PostUserRequest $request)
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
            
            $user = User::create($data);
            // foreach ($request->kelas_id as $kelas) {
            //     PenggunaKelas::create(['kelas_id' => $kelas, 'user_id' => $user->id]);
            // }

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
        $roles = ['super admin','admin','user'];
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
            foreach ($request->kelas_id as $kelas) {
                $kelas->update(['kelas_id' => $kelas]);
            }

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
}
