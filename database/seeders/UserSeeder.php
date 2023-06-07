<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\User;
use App\Models\WaliKelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $dataAkun = [
            'nama' => 'patir',
            'jk'=>'L',
            'email'=>'patir@gmail.com',
            'password'=>'password',
            'role'=>'walas',
        ];
        
        $user = User::create($dataAkun);

        $dataguru = [
            'user_id' => $user->id,
            'visi'=>'aaaaaa',
            'misi'=>'bbbbb',
        ];
        $datawalas = [
            'user_id' => $user->id,
            'kelas_id' => 1
        ];

        $user->role == 'guru' ? Guru::create($dataguru) : '';
        $user->role == 'walas' ? WaliKelas::create($datawalas) : '';
    }
}
