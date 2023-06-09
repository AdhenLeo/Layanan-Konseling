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
        $data = [
            'user_id' => Auth::user()->id,
            'status' => $status
        ];

        Log::create($data);
    }
}