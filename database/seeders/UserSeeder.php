<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\User;
use App\Models\UserKelas;
use App\Models\WaliKelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $dataAkun = [
            'nama' => 'patir',
            'jk'=>'L',
            'email'=>'patir@gmail.com',
            'password'=>Hash::make('password'),
            'role'=>'walas',
        ];
        
        $user = User::create($dataAkun);

        UserKelas::create([
            'user_id' => $user->id,
            'kelas_id' => 1
        ]);

        $dataguru = [
            'user_id' => $user->id,
            'visi'=>'aaaaaa',
            'misi'=>'bbbbb',
        ];

        $user->role == 'guru' ? Guru::create($dataguru) : '';
    }
}
