<?php

use App\Models\{
    Guru,
    Kelas,
    Pengguna,
    Log,
    UserKelas
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('insertLog')) {
    function insertLog($request)
    {
        $id = Auth::user()->id;
        $query = "CALL insertLog(?, ?)";
        DB::select($query, [$id, $request]);
    }
}

if (!function_exists('getSiswaGuru')) {
    function getSiswaGuru()
    {
        if(Auth::user()->role == "guru"){
            $kelasGuru = UserKelas::with('user', 'kelas')->where('user_id', Auth::user()->id)->pluck('kelas_id');
            $kelasSiswa = UserKelas::with('user', 'kelas')->whereIn('kelas_id',$kelasGuru)->get();
            $siswas = [];
            foreach ($kelasSiswa as $i => $data) {
                $data->user->role == 'user' ? $siswas[] = $data : null;
            }

            return $siswas;
        }
    }
}

if (!function_exists('getGuruSiswa')) {
    function getGuruSiswa()
    {
        if(Auth::user()->role == "user"){
            $kelasSiswa = UserKelas::with('user', 'kelas')->where('user_id', Auth::user()->id)->pluck('kelas_id');
            $kelasGuru = UserKelas::with('user', 'kelas')->whereIn('kelas_id',$kelasSiswa)->get();
            $guru = [];
            foreach ($kelasGuru as $i => $data) {
                $data->user->role == 'guru' ? $guru[] = $data : null;
            }

            return $guru[0];
        }
    }
}