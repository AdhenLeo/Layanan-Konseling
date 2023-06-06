<?php

namespace App\Http\Controllers;

use App\Models\{
    Kelas,
    Pengguna
};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $penggunas = Pengguna::all();
        return view('dashboard', compact('kelas', 'penggunas'));
    }
}
