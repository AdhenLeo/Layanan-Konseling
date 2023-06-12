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
        'profile' => '/img/profile.png',
        'password' =>Hash::make ('123123'),
        'role' => 'user',
       ];
       $dataAdmin =  [
        'nama' => 'admin',
        'nip' => '23023312',
        'jk' => 'L',
        'email' => 'admin@gmail.com',
        'profile' => '/img/profile.png',
        'password' =>Hash::make('123123'),
        'role' => 'admin',
       ];
       
       $dataWalas =  [
        'nama' => 'usersRole',
        'nip' => '230132312',
        'jk' => 'L',
        'email' => 'walas@gmail.com',
        'profile' => '/img/profile.png',
        'password' =>Hash::make ('123123'),
        'role' => 'user',
       ];
       $dataGuru =  [
        'nama' => 'Guru',
        'nip' => '49320423',
        'jk' => 'L',
        'email' => 'guru@gmail.com',
        'profile' => '/img/profile.png',
        'password' =>Hash::make ('123123'),
        'role' => 'guru',
       ];
        
        $user = User::create($dataWalas);
        $user = User::create($dataAdmin);
        $user = User::create($dataUser);
        $dataGuru =  [
            'user_id' =>$user->id,
            'biodata' => 'biodata',
            'visi' => 'visinya',
            'misi' => 'misiii',
           ];
        $user = Guru::create($dataGuru);

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
