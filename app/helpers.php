<?php

use App\Models\ {
    Kelas,
    Pengguna,
    Log
};
use Illuminate\Support\Facades\Auth;

if(function_exists('insertLog')){
    function insertLog($id, $status){
        $data = [
            'pengguna_id' => $id,
            'status' => $status
        ];

        Log::create($data);
    }
}
