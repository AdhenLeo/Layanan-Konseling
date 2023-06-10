<?php

use App\Models\{
    Guru,
    Kelas,
    Pengguna,
    Log
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('insertLog')) {
    function insertLog($status)
    {
        // $id = Auth::user()->id;
        $query = "CALL insertLog(?, ?)";
        DB::select($query, [1, $status]);
    }
}