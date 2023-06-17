<?php

use App\Models\{
    Guru,
    Kelas,
    Pengguna,
    Log,
    Pertemuan,
    User,
    UserKelas
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('insertLog')) {
    function insertLog($request, $id = null)
    {
        $id = $id ?? Auth::user()->id;
        $query = "CALL insertLog(?, ?)";
        DB::select($query, [$id, $request]);
    }
}

if (!function_exists('getKelas')) {
    function getKelas()
    {
        $kelass = UserKelas::with('user', 'kelas')->get();
        $datas = [];
        foreach ($kelass as $i => $kelas) {
            $kelas->user->role == 'guru' ? $datas[] = $kelas->kelas_id : null;
        }

        return $datas;
    }
}

if (!function_exists('getSiswaGuru')) {
    function getSiswaGuru()
    {
        if (Auth::user()->role == "guru" || Auth::user()->role == "walas") {
            $kelasGuru = UserKelas::with('user', 'kelas')->where('user_id', Auth::user()->id)->pluck('kelas_id');
            $kelasSiswa = UserKelas::with('user', 'kelas')->whereIn('kelas_id', $kelasGuru)->get();
            $siswas = [];
            foreach ($kelasSiswa as $i => $data) {
                Auth::user()->role == 'guru' ? ($data->user->role == 'user' ? $siswas[] = $data : null) : $siswas[] = $data->user->id;
            }

            return $siswas;
        } else if (Auth::user()->role == 'user') {
            $user = User::with('kelas')->find(Auth::user()->id);
            // by kelas
            // $datas = UserKelas::with('user', 'kelas')->where('kelas_id', $user->kelas->first()->id)->get();

            // semua murid
            $datas = User::with('kelas')->where('role', 'user')->get();

            $siswas = [];
            foreach ($datas as $siswa) {
                $siswa->id != Auth::user()->id ? $siswas[] = $siswa : null;
            }

            return $siswas;
        }
    }
}

if (!function_exists('getGuruSiswa')) {
    function getGuruSiswa()
    {
        if (Auth::user()->role == "user") {
            $kelasSiswa = UserKelas::with('user', 'kelas')->where('user_id', Auth::user()->id)->pluck('kelas_id');
            $kelasGuru = UserKelas::with('user', 'kelas')->whereIn('kelas_id', $kelasSiswa)->get();
            $guru = [];
            foreach ($kelasGuru as $i => $data) {
                $data->user->role == 'guru' ? $guru[] = $data : null;
            }

            return $guru[0];
        }
    }
}

if (!function_exists('getPertemuanWalas')) {
    function getPertemuans()
    {
        if (Auth::user()->role == "walas") {
            $siswas = getSiswaGuru();
            $datas = Pertemuan::with('user', 'guru')->whereIn('user_id', $siswas)->orderBy('id', 'DESC')->paginate(4);
        } elseif (Auth::user()->role == "guru") {
            $datas = Pertemuan::with('user', 'guru')->where('guru_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(4);
        } elseif (Auth::user()->role == "user") {
            $datas = Pertemuan::with('user', 'guru')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(4);
        }

        return $datas;
    }
}

if (!function_exists('getCountAndPertemuans')) {
    function getCountAndPertemuans()
    {
        if (Auth::user()->role == 'guru') {
            // menghitung count berdasarkan role
            $countacc = Pertemuan::where('guru_id', Auth::user()->id)->where('status', 'accept')->get();
            $countpending = Pertemuan::where('guru_id', Auth::user()->id)->where('status', 'pending')->get();
            $countwaiting = Pertemuan::where('guru_id', Auth::user()->id)->where('status', 'waiting')->get();

            // menggenerate pertemuan di dashboard di setiap role
            $pertemuans = Pertemuan::with('user', 'guru')->where('guru_id', Auth::user()->id)->orderBy('id', 'DESC')->where('status', 'waiting')->paginate(4);
        } else if (Auth::user()->role == 'walas') {
            $siswas = getSiswaGuru();

            // menghitung count berdasarkan role
            $countacc = Pertemuan::whereIn('user_id', $siswas)->where('status', 'accept')->get();
            $countpending = Pertemuan::whereIn('user_id', $siswas)->where('status', 'pending')->get();
            $countwaiting = Pertemuan::whereIn('user_id', $siswas)->where('status', 'waiting')->get();

            // menggenerate pertemuan di dashboard di setiap role
            $pertemuans = Pertemuan::with('user', 'guru')->whereIn('user_id', $siswas)->where('status', 'waiting')->orderBy('id', 'DESC')->paginate(4);
        } elseif (Auth::user()->role == 'user') {
            // menghitung count berdasarkan role
            $countacc = Pertemuan::where('user_id', Auth::user()->id)->where('status', 'accept')->get();
            $countpending = Pertemuan::where('user_id', Auth::user()->id)->where('status', 'pending')->get();
            $countwaiting = Pertemuan::where('user_id', Auth::user()->id)->where('status', 'waiting')->get();

            // menggenerate pertemuan di dashboard di setiap role
            $pertemuans = Pertemuan::with('user', 'guru')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->where('status', 'waiting')->paginate(4);
        } elseif (Auth::user()->role == 'admin') {
            // menghitung count berdasarkan role
            $countacc = Pertemuan::where('status', 'accept')->get();
            $countpending = Pertemuan::where('status', 'pending')->get();
            $countwaiting = Pertemuan::where('status', 'waiting')->get();

            // menggenerate pertemuan di dashboard di setiap role
            $pertemuans = Pertemuan::with('user', 'guru')->orderBy('id', 'DESC')->where('status', 'waiting')->paginate(4);
        }
        return [
            'countacc' => $countacc,
            'countpending' => $countpending,
            'countwaiting' => $countwaiting,
            'pertemuans' => $pertemuans,
        ];
    }
}

if (!function_exists('getSiswaPetakerawanan')) {
    function getSiswaPetakerawanan($idkelas)
    {
        // $kelasGuru = UserKelas::with('user', 'kelas')->where('user_id', Auth::user()->id)->pluck('kelas_id');
        // $kelasSiswa = UserKelas::with('user', 'kelas')->whereIn('kelas_id', $kelasGuru)->get();
        $kelasSiswa = UserKelas::with('user', 'kelas')->where('kelas_id', $idkelas)->get();
        $siswas = [];
        foreach ($kelasSiswa as $i => $data) {
            if(Auth::user()->role == 'guru' && $data->user->role == 'user'){
                $siswas[] = $data->user;
            } 
        }

        return $siswas;
    }
}
