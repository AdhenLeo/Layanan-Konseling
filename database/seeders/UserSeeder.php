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
       $dataUser =  [
        'nama' => 'usersRole',
        'nip' => '23023912',
        'jk' => 'L',
        'email' => 'user@gmail.com',
        // 'profile' => 'img/profile.png',
        'password' =>Hash::make ('123123'),
        'role' => 'user',
       ];
       $dataAdmin =  [
        'nama' => 'admin',
        'nip' => '23023312',
        'jk' => 'L',
        'email' => 'admin@gmail.com',
        // 'profile' => '/img/profile.png',
        'password' =>Hash::make('123123'),
        'role' => 'admin',
       ];
       
       $dataWalas =  [
        'nama' => 'usersRole',
        'nip' => '230132312',
        'jk' => 'L',
        'email' => 'walas@gmail.com',
        // 'profile' => '/img/profile.png',
        'password' =>Hash::make ('123123'),
        'role' => 'walas',
       ];
       $dataAkunGuru =  [
        'nama' => 'Guru',
        'nip' => '49320423',
        'jk' => 'L',
        'email' => 'guru@gmail.com',
        // 'profile' => '/img/profile.png',
        'password' =>Hash::make ('123123'),
        'role' => 'guru',
       ];
        
        $walas = User::create($dataWalas);
        $admin = User::create($dataAdmin);
        $siswa = User::create($dataUser);
        
        $guru = User::create($dataAkunGuru);
        $dataGuru =  [
            'user_id' =>$guru->id,
            'biodata' => 'biodata',
            'visi' => 'visinya',
            'misi' => 'misiii',
           ];
        Guru::create($dataGuru);

        UserKelas::create([
            'user_id' => $siswa->id,
            'kelas_id' => 1
        ]);
        UserKelas::create([
            'user_id' => $walas->id,
            'kelas_id' => 1
        ]);
        UserKelas::create([
            'user_id' => $admin->id,
            'kelas_id' => 1
        ]);
        UserKelas::create([
            'user_id' => $guru->id,
            'kelas_id' => 1
        ]);

    }
}
